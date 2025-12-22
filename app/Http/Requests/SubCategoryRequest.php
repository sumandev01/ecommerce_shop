<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
        $name = $this->method() === 'PUT' ? 'required|string|max:255|unique:sub_categories,name,' . $this->subcategory->id : 'required|string|max:255|unique:sub_categories,name';
        $slug = $this->method() === 'PUT' ? 'required|string|max:255|unique:sub_categories,slug,' . $this->subcategory->id : 'nullable|string|max:255|unique:sub_categories,slug'; //nullable|string
        return [
            'name' => $name,
            'slug' => $slug,
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The sub-category name is required.',
            'name.unique' => 'The sub-category is already created.',
            'slug.required' => 'The slug is required.',
            'category.required' => 'The category is required.',
            'category.exists' => 'The selected category is invalid.',
        ];
    }
}
