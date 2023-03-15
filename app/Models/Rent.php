<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'book_id',
        'customer_id',
        'employee_id',
        'date_rent',
        'date_return'
    ];

    protected $guarded = ['id'];

    public function getbook()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function getcustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getemployee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
