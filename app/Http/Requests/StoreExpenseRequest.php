<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'account_id' => 'required',
            'currency_id' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'attachment' => 'nullable|file',
            'note' => 'nullable',
            'reference' => 'nullable',
            'expense_date' => 'required',
        ];
    }


    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'account_id.required' => 'Please select a bank account',
            'currency_id.required' => 'Please select currency',
            'amount.required' => 'Please add your expense amount',
            'category_id.required' => 'Please select an income category',
        ];
    }
}
