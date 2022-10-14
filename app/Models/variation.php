<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variation extends Model
{
    use HasFactory;

    protected $table = "variations";

    public function product()
    {
        return $this->belongsTo(variation::class);
    }
}
