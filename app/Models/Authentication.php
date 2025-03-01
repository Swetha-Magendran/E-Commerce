<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;
    protected $table = 'authentication';
    protected $fillable = [
        'authority',
        'user_name',
        'mobile',
        'email',
        'password',
        'status'
    ];
}
