<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Stock extends Model
{
    use HasFactory;
    protected $table = 'products_stock';
    protected $fillable = [
        'product_id',
        'product_code',
        'product_stock',
        'product_recevied_from'
    ];  
}
