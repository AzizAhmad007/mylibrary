<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name_customer',
        'gender',
        'phone_customer',
        'address_customer'
    ];

    protected $guarded = ['id'];
}
