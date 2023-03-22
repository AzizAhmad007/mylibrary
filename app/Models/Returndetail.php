<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returndetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'returnbook_id',
        'book_code'
    ];

    protected $guarded = ['id'];

    public function getretundetail()
    {
        return $this->hasMany(ReturnBook::class, 'returnbook_id', 'id');
    }

    public function getbook()
    {
        return $this->belongsTo(Book::class, 'book_code', 'code');
    }
}
