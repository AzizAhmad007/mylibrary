<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_code',
        'rent_return_date',
        'charge'
    ];

    protected $guarded = ['id'];

    public function getrent()
    {
        return $this->belongsTo(Rent::class, 'rent_code', 'code');
    }

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rent_return_date', 'return_date');
    }
}
