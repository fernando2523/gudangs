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


    public function warehouse()
    {
        return $this->hasMany(Warehouse::class, 'id_ware', 'id_ware');
    }
}
