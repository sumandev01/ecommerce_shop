<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $thambnail = $this->method() === 'PUT' ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        return [
            'name' => 'required|string|max:255',
            'shortDescription' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'subCategory' => 'required|exists:sub_categories,id',
            'product_sku' => 'required|string|max:255',
            'buy_Price' => 'required|numeric',
            'sell_Price' => 'required|numeric',
            'discount_Price' => 'nullable|numeric',
            'thambnail' => $thambnail,
        ];
    }
}
