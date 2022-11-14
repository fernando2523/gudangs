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
        return $this->hasMany(Sale::class, 'id_invoice', 'id_invoice');
    }

    public function store()
    {
        return $this->hasMany(Store::class, 'id_store', 'id_store');
    }
}
