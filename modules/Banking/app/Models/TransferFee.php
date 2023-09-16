<?php

namespace Banking\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferFee extends Model
{
    use HasFactory;

    protected $fillable =[
        'amount'
    ];
}
