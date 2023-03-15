<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_code',
        'date_return',
        'employee_id'
    ];

    protected $guarded = ['id'];

    public function getrent()
    {
        return $this->hasMany(Rent::class, 'rent_code', 'code');
    }

    public function getemployee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
