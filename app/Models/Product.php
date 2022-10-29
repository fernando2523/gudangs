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
        // $$dataproduk = DB::table('products')
        //     ->select('id_ware')
        //     ->groupBy('id_ware')
        //     ->get();

        // $datass = $dataproduk->toArray();

        // return $this->hasMany(variation::class, 'id_produk', 'id_produk')
        //     ->where(function ($query) {
        //         $query->where('id_produk', $this->id_produk)
        //             ->orWhere('id_ware', $this->id_ware);
        //     });

        // return variation::where(function ($query) {
        //     $query->where('id_produk', $this->id_produk)
        //         ->orWhere('id_ware', $this->id_ware);
        // });

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
}
