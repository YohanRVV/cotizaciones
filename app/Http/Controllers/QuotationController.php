<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;

class QuotationController extends Controller
{
    public function index()
    {
        $clients = Client::all(); 
        $products = Product::where('status', 'disponible')->get(); 
        
        return inertia('QuotationScreen', [
            'clients' => $clients,
            'products' => $products,
        ]);
    }
}
