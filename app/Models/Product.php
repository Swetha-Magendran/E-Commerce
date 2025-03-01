<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_code',
        'category_id',
        'sub_category_id',
        'product_image',
        'measurment',
        'price',
        'discount',
        'status',
        'description'
    ];
}
