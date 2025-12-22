<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $name = $this->method() === 'PUT' ? 'required|string|max:255|unique:brands,name,' . $this->brand->id : 'required|string|max:255|unique:brands,name';
        $slug = $this->method() === 'PUT' ? 'required|string|max:255|unique:brands,slug,' . $this->brand->id : 'nullable|string|max:255|unique:brands,slug';
        return [
            'name' => $name,
            'slug' => $slug,
            'image' => 'nullable|image|max:2048',
        ];
    }
}
