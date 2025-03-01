<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing_Details extends Model
{
    use HasFactory;
    protected $table = 'billing_details';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'mobile',
        'landmark',
        'city',
        'country',
        'postcode'
    ];
}
