<?php

namespace Banking\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'card_prefix'
    ];
}
