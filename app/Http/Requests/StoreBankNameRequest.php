<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBankNameRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'bank_name' => [
                'required',
                'string',
                'max:255',
                // Ensure uniqueness in bank_names table scoped by user_id
                Rule::unique('bank_names')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
        ];
    }
}
