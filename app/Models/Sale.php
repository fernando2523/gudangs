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

    public function details2()
    {
        return $this->hasMany(Sale::class, 'id_invoice', 'id_invoice')->selectRaw('*,SUM(qty) as qty,sum(m_price*qty) as cost,SUM(diskon_item) as diskon_item,SUM(subtotal) as subtotal')->groupBy('id_produk', 'size');
    }

    public function store()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }

    public function reseller()
    {
        return $this->hasMany(Reseller::class, 'id_reseller', 'id_reseller');
    }

    public function image_product()
    {
        return $this->hasMany(Image_product::class, 'id_produk', 'id_produk');
    }

    ///////////////////////////////////////////////////////////////////////////
    // report product
    public function qtys()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->selectRaw('*,SUM(qty) as qty')->groupBy('id_produk');
    }

    public function disc_item()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->groupBy('id_produk')->selectRaw('*,SUM(diskon_item) as disc');
    }

    public function disc_all()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk')->groupBy('id_produk');
    }

    public function gross()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }

    public function costs()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }

    public function profit()
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id_produk');
    }
    //end report product
    ///////////////////////////////////////////////////////////////////////////
    // report store
    public function store_qtys()
    {
        return $this->hasMany(Sale::class, 'id_store', 'id_store')->selectRaw('*,SUM(qty) as qty');
    }

    public function store_gross()
    {
        return $this->hasMany(Sale::class, 'id_store', 'id_store');
    }

    public function store_disc_item()
    {
        return $this->hasMany(Sale::class, 'id_store', 'id_store')->groupBy('id_store')->selectRaw('*,SUM(diskon_item) as disc');
    }

    public function store_costs()
    {
        return $this->hasMany(Sale::class, 'id_store', 'id_store');
    }
    // END report store
    ///////////////////////////////////////////////////////////////////////////
    // report brand
    public function brand_qtys()
    {
        return $this->hasMany(Sale::class, 'id_brand', 'id_brand')->selectRaw('*,SUM(qty) as qty');
    }

    public function brand_gross()
    {
        return $this->hasMany(Sale::class, 'id_brand', 'id_brand');
    }

    public function brand_disc_item()
    {
        return $this->hasMany(Sale::class, 'id_brand', 'id_brand')->groupBy('id_brand')->selectRaw('*,SUM(diskon_item) as disc');
    }

    public function brand_costs()
    {
        return $this->hasMany(Sale::class, 'id_brand', 'id_brand');
    }
    // END report brand
    ///////////////////////////////////////////////////////////////////////////

    // report quality
    public function quality_qtys()
    {
        return $this->hasMany(Sale::class, 'quality', 'quality')->selectRaw('*,SUM(qty) as qty');
    }

    public function quality_gross()
    {
        return $this->hasMany(Sale::class, 'quality', 'quality');
    }

    public function quality_disc_item()
    {
        return $this->hasMany(Sale::class, 'quality', 'quality')->groupBy('quality')->selectRaw('*,SUM(diskon_item) as disc');
    }

    public function quality_costs()
    {
        return $this->hasMany(Sale::class, 'quality', 'quality');
    }
    //END report quality
    ///////////////////////////////////////////////////////////////////////////
}
