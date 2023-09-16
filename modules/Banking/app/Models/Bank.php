<?php

namespace Banking\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Banking\database\factories\BankFactory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'branch',
        'address',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(BankAccount::class,'bank_id');
    }

    protected static function newFactory(): Factory|BankFactory
    {
        return BankFactory::new();
    }
}
