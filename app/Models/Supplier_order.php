<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_order extends Model
{
    use HasFactory;

    protected $table = "supplier_orders";

    public function supplier_variation()
    {
        return $this->hasMany(Supplier_variation::class, 'idpo', 'idpo')->orderBy('idpo');
    }

    public function suppliers_detail()
    {
        return $this->hasMany(Supplier::class, 'id_sup', 'id_sup');
    }

    public function suppliers_details()
    {
        return $this->hasMany(Supplier_order::class, 'idpo', 'idpo');
    }

    public function product_variation_asset()
    {

        return $this->hasMany(variation::class, 'id_produk', 'id_produk');
    }
}
