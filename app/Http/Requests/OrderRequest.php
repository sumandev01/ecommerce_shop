<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ];

        if ($this->input('differentAddress')) {
            $rules['shipping_name'] = 'required|string|max:255';
            $rules['shipping_email'] = 'required|email|max:255';
            $rules['shipping_phone'] = 'required|string|max:20';
            $rules['shipping_address'] = 'required|string|max:500';
            $rules['shipping_country'] = 'required|string|max:100';
            $rules['shipping_city'] = 'required|string|max:100';
            $rules['shipping_postcode'] = 'required|string|max:20';
        }

        return $rules;
    }
}
