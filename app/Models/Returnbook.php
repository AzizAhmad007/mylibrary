<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Returnbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_code',
        'customer_code',
        'user_id',
        'date_return',
        'rent_date_promise',
        'charge',
    ];

    protected $guarded = ['id'];

    public function getrent()
    {
        return $this->hasMany(Rent::class, 'rent_code', 'rent_date_promise', 'date_promise', 'code');
    }

    public function getcustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_code', 'code');
    }

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y H:i:s'),
        );
    }
}
