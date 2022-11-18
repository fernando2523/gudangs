<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    public function details()
    {
        return $this->hasMany(Sale::class, 'id_invoice', 'id_invoice')->selectRaw('*,SUM(qty) as qty,SUM(diskon_item) as diskon_item,SUM(subtotal) as subtotal')->groupBy('id_produk', 'size');
    }

    public function store()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }

    public function reseller()
    {
        return $this->hasMany(Reseller::class, 'id_reseller', 'id_reseller');
    }
}
