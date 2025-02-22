<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDebtRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'account_id' => 'required|exists:bank_accounts,id',
            'currency_id' => 'required',
            'type' => 'required|in:lend,repayment,borrow,debt-collection',
            'person' => 'required|string',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'account_id.required' => 'Please select a bank account',
            'currency_id.required' => 'Please select currency'
        ];
    }
}
