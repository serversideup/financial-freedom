<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required',
            'number' => 'required_unless:type,cash',
            'description' => 'required',
            'institution' => 'required_unless:type,cash',
            'open_date' => 'required_if:type,loan',
            'payment_amount' => 'required_if:type,loan|numeric',
            'initial_balance' => 'required|numeric',
            'interest_rate' => 'required_if:type,loan|numeric'
        ];
    }
}
