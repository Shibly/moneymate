<?php


// app/Http/Requests/StoreIncomeRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Add authorization logic here if needed
        return true; // Allow everyone to make this request for now
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'account_id' => 'required|exists:bank_accounts,id',
            'currency_id' => 'required|exists:currencies,id',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'income_date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:500',
            'reference' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:10240', // 10MB max
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'account_id.required' => 'The bank account is required.',
            'currency_id.required' => 'The currency is required.',
            'amount.required' => 'The amount is required.',
            'category_id.required' => 'The category is required.',
            'income_date.required' => 'The income date is required.',
            'income_date.date' => 'The income date must be a valid date.',
            'attachment.mimes' => 'The attachment must be a file of type: jpeg, png, pdf, docx.',
            'attachment.max' => 'The attachment may not be greater than 10 MB.',
        ];
    }
}
