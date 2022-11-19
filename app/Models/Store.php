<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = "stores";

    public function warehouses()
    {

        return $this->hasMany(Warehouse::class, 'id_ware', 'id_ware');
    }

    public function sales()
    {

        return $this->hasMany(Sale::class, 'id_store', 'id_store')->groupBy('id_store');
    }
}
