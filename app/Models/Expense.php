<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'month_id', 'description', 'amount', 'bank_account', 'status'
    ];

    public function month()
    {
        return $this->belongsTo(Month::class);
    }
}
