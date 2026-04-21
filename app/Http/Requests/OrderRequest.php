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
            'charge' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ];

        if ($this->input('differentAddress') == 'on') {
            $rules['shippingName'] = 'required|string|max:255';
            $rules['shippingEmail'] = 'required|email|max:255';
            $rules['shippingPhone'] = 'required|string|max:20';
            $rules['shippingAddress'] = 'required|string|max:500';
            $rules['shippingCountry'] = 'required|string|max:100';
            $rules['shippingCity'] = 'required|string|max:100';
            $rules['shippingPost'] = 'required|string|max:20';
            $rules['shippingCompany'] = 'nullable|string|max:255';
        }

        return $rules;
    }
}
