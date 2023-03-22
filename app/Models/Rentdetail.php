<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_code',
        'book_code'
    ];

    protected $guarded = ['id'];

    public function getrent()
    {
        return $this->hasMany(Rent::class, 'rent_code', 'code');
    }

    public function getbook()
    {
        return $this->belongsTo(Book::class, 'book_code', 'code');
    }
}
