<?php

// app/Http/Requests/UpdateIncomeRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Ensure the user is authorized to update the income
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
            'account_id' => 'required|exists:bank_accounts,id',
            'category_id' => 'required|exists:categories,id',
            'currency_id' => 'required|exists:currencies,id',
            'amount' => 'required|numeric|min:0.01',
            'income_date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'reference' => 'nullable|string|max:250',
            'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx,zip',
        ];
    }

    /**
     * Get custom attributes for validation errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'account_id' => 'bank account',
            'category_id' => 'income category',
            'currency_id' => 'currency',
            'amount' => 'income amount',
            'income_date' => 'income date',
            'description' => 'description',
            'note' => 'note',
            'reference' => 'reference',
            'attachment' => 'attachment',
        ];
    }
}
