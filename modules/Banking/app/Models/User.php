<?php

namespace Banking\Models;
use App\Models\User as BaseUser;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends BaseUser
{
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class,'user_id');
    }
}
