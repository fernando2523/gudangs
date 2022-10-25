<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variation extends Model
{
    use HasFactory;

    protected $table = "variations";

    protected $fillable = [
        'size',
        'qty',
    ];

    // public function product()
    // {
    //     return $this->hasMany(Product::class, 'id_produk', 'id_produk')->orderBy('id');
    // }
}
