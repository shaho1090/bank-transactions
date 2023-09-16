<?php

namespace Banking\Http\Requests;

use Banking\Models\Setting;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CardToCardTransferStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $minimumAmount = (new Setting())->getCardToCardMinimumAmount();
        $maximumAmount = (new Setting())->getCardToCardMaximumAmount();

        return [
            'origin_card' => ['required', 'exists:bank_cards,card_number'],
            'destination_card' => ['required', 'exists:bank_cards,card_number'],
            'amount' => ['required', 'numeric', 'gte:'.$minimumAmount, 'lte:'.$maximumAmount]
        ];
    }
}
