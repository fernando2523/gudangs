<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    public function product_variation()
    {
        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->orderBy('size');
    }

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class, 'id_ware', 'id_ware');
    }
}
