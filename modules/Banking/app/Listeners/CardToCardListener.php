<?php

namespace Banking\Listeners;

use Banking\Events\CardToCardEvent;
use Banking\Models\BankCard;
use Banking\Notification\CardDepositNotification;
use Banking\Notification\CardWithdrawalNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardToCardListener// implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CardToCardEvent $event): void
    {
        $sender = BankCard::query()->find($event->transfer->from_id)->BankAccount->owner;
        $receiver = BankCard::query()->find($event->transfer->to_id)->BankAccount->owner;

        $sender->notify(new CardWithdrawalNotification($event->transfer));
        $receiver->notify(new CardDepositNotification($event->transfer));

        info($sender->bankAccount->owner);

//        info(json_encode($event->transfer->toArray()));
    }
}
