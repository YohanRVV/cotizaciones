<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function storePurchase(Request $request)
    {
        $clientId = $request->client_id;
        $cart = $request->cart;

        if (!$clientId || empty($cart)) {
            return response()->json(['message' => 'El cliente o el carrito están vacíos.'], 400);
        }

        try {
            DB::transaction(function () use ($clientId, $cart) {
                $totalPrice = array_reduce($cart, function ($carry, $item) {
                    return $carry + ($item['quantity'] * $item['price']);
                }, 0);

                $purchase = Purchase::create([
                    'client_id' => $clientId,
                    'total_price' => $totalPrice,
                ]);

                foreach ($cart as $item) {
                    $product = Product::find($item['id']);
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("El producto {$product->name} no tiene suficiente stock.");
                    }

                    PurchaseProduct::create([
                        'purchase_id' => $purchase->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['price'],
                        'subtotal' => $item['quantity'] * $item['price'],
                    ]);

                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            });

            return response()->json(['message' => 'Compra realizada exitosamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al realizar la compra: ' . $e->getMessage()], 500);
        }
    }
    public function purchaseHistory()
    {
        $clients = Client::withCount('purchases')->get();

        return inertia('PurchaseHistory', [
            'clients' => $clients,
        ]);
    }
    public function getClientPurchases($clientId)
    {
        $client = Client::with('purchases.purchaseProducts.product')->findOrFail($clientId);
    
        $groupedPurchases = $client->purchases->flatMap(function ($purchase) {
            return $purchase->purchaseProducts->map(function ($purchaseProduct) {
                return [
                    'product_name' => $purchaseProduct->product->name,
                    'total_quantity' => $purchaseProduct->quantity,
                    'total_price' => $purchaseProduct->quantity * $purchaseProduct->unit_price,
                ];
            });
        })->groupBy('product_name')->map(function ($items, $productName) {
            return [
                'product_name' => $productName,
                'total_quantity' => $items->sum('total_quantity'),
                'total_price' => $items->sum('total_price'),
            ];
        })->values();
    
        return response()->json([
            'purchases' => $groupedPurchases,
            'total' => $groupedPurchases->sum('total_price'),
        ]);
    }
    
}
