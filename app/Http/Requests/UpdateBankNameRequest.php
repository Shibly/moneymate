<?php

namespace App\Http\Requests;

use App\Models\BankName;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBankNameRequest extends FormRequest
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


        $bankId = $this->route('bank'); // This is just the ID, not the model
        $bank = BankName::find($bankId); // Retrieve the model instance

        return [
            'bank_name' => [
                'required',
                Rule::unique('bank_names')
                    ->where(fn($query) => $query->where('user_id', auth()->user()->id))
                    ->ignore($bank?->id), // Ignore the current bank's ID
            ]
        ];

    }
}
