<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactiondetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_date_return',
        'returnbook_date_return',
        'charge'
    ];

    protected $guarded = ['id'];

    public function getrent()
    {
        return $this->belongsTo(Rent::class, 'rent_date_return', 'date_return');
    }

    public function getreturnbook()
    {
        return $this->belongsTo(Returnbook::class, 'returnbook_date_return', 'date_return');
    }
}
