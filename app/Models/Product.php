<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function product_variation()
    {

        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->orderBy('size');
    }

    public function product_variation2()
    {

        return $this->hasMany(variation::class, 'id_produk', 'id_produk')->orderBy('size');
    }

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class, 'id_ware', 'id_ware');
    }

    public function image_product()
    {
        return $this->hasMany(Image_product::class, 'id_produk', 'id_produk');
    }

    public function supplier_order()
    {
        return $this->hasMany(Supplier_order::class, 'id_produk', 'id_produk');
    }

    public function supplier_variation()
    {
        return $this->hasMany(supplier_variation::class, 'id_produk', 'id_produk');
    }
}
