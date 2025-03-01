<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporary_Cart extends Model
{
    use HasFactory;
    protected $table = 'temporary_carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'product_image',
        'price',
        'discount',
        'quantity',
        'total'
    ];
}
