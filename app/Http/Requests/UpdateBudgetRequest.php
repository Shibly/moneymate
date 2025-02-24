<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBudgetRequest extends FormRequest
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
            'budget_name' => 'required|string',
            'currency_id' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'currency_id.required' => 'Please select currency',
        ];
    }
}
