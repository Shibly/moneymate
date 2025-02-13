<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120|unique:currencies,name',
            'exchange_rate' => 'required|numeric|min:0',
            'is_default' => 'nullable|string|in:yes,no',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The currency name is required.',
            'name.string' => 'The currency name must be a string.',
            'name.max' => 'The currency name must not exceed 120 characters.',
            'name.unique' => 'The currency name must be unique.',
            'exchange_rate.required' => 'The exchange rate is required.',
            'exchange_rate.numeric' => 'The exchange rate must be a numeric value.',
            'exchange_rate.min' => 'The exchange rate must be at least 0.',
            'is_default.in' => 'The value of is_default must be either "yes" or "no".',
        ];
    }
}
