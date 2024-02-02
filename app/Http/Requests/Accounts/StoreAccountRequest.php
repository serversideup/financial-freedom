<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_type' => 'required|string',
            'name' => 'required|string',
            'institution_id' => 'required|exists:institutions,id',
            'description' => 'nullable|string',
            'type' => 'nullable|required_unless:account_type,credit-card|string',
            'balance' => 'required|numeric',
            'remaining_balance' => 'nullable|required_if:account_type,loan|numeric',
            'original_balance' => 'nullable|required_if:account_type,loan|numeric',
            'payment_amount' => 'nullable|required_if:account_type,loan|numeric',
            'interest_rate' => 'nullable|numeric', 
            'date_opened' => 'nullable|date',
            'credit_limit' => 'nullable|numeric',
            'brand' => 'nullable|required_if:account_type,credit-card|string',
        ];
    }
}
