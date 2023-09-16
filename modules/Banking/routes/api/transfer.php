<?php


use Banking\Http\Controllers\CardToCardTransferController;
use Illuminate\Support\Facades\Route;

Route::post('/transfers/card-to-card',[CardToCardTransferController::class,'store'])
    ->name('transfer.card.store');
