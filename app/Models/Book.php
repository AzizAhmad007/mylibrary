<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'rack_id',
        'category_id',
        'title',
        'author',
        'publisher_book',
        'publisher_year',
        'stock'
    ];

    protected $guarded = ['id'];

    public function getrack()
    {
        return $this->belongsTo(Rack::class, 'rack_id', 'id');
    }

    public function getcategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
