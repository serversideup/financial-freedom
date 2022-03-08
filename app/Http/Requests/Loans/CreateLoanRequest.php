<?php

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
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
            'number' => 'required|numeric',
            'institution' => 'required',
            'description' => 'required',
            'open_date' => 'required',
            'interest_rate' => 'required',
            'payment_amount' => 'required',
            'current_balance' => 'required|numeric'
        ];
    }
}
