<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_code',
        'user_id',
        'date_rent',
        'date_promise',
        'jumlah_buku_pinjam'
    ];

    protected $guarded = ['id'];

    public function getcustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_code', 'code');
    }

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
