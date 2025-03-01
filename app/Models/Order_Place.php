<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Place extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'product_image',
        'price',
        'quantity',
        'total',
        'payment_mode'
    ];
}
