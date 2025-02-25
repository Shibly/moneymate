<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {

        $categoryId = $this->route('category');
        $category = Category::find($categoryId);

        return [
            'name' => [
                'required',
                Rule::unique('categories')
                    ->where(fn($query) => $query->where('user_id', auth()->user()->id))
                    ->ignore($category?->id),
            ],
            'type' => 'sometimes|in:income,expense',
            'category_color' => 'nullable|string|max:10',
        ];
    }
}
