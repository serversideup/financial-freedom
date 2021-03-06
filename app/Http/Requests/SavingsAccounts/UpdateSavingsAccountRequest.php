<?php

namespace App\Http\Requests\SavingsAccounts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSavingsAccountRequest extends FormRequest
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
            'description' => 'required',
            'current_balance' => 'required|numeric'
        ];
    }
}
