<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillabel = [
        'book_id',
        'user_id',
        'loan_date',
        'return_date',
        'status'
    ];
}
