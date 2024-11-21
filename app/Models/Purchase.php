<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'total_price',
    ];

    /**
     * Relación con los productos adquiridos.
     */
    public function purchaseProducts()
    {
        return $this->hasMany(PurchaseProduct::class);
    }

    /**
     * Relación con el cliente que realizó la compra.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
