<?php

namespace App\Http\Requests\Rules;

use App\Data\Rules\StoreRuleData;
use Illuminate\Foundation\Http\FormRequest;

class StoreRuleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search_string' => 'required|string',
            'replace_string' => 'required|string',
        ];
    }

    /**
     * Build and return a DTO.
     *
     * @return StoreRuleData
     */
    public function toDto(): StoreRuleData
    {
        return new StoreRuleData(
            account: $this->account,
            searchString: $this->search_string,
            replaceString: $this->replace_string,
            category: $this->category,
        );
    }
}
