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
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'name'             => 'required|string|max:255',
            'slug'             => [
                'nullable',
                'string',
                'max:255',
                $isUpdate ? 'unique:products,slug,' . $this->product->id : 'unique:products,slug'
            ],
            'shortDescription' => 'required|string|max:500',
            'description'      => 'nullable|string|max:1000',
            'additional_info'  => 'nullable|string|max:1000',
            'buy_price'        => 'required|numeric|min:0',
            'price'            => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0|lt:price',
            'sku'              => 'required|string|max:255',
            'stock_quantity'   => 'required|integer|min:0',
            'category'         => 'required|exists:categories,id',
            'subCategory'      => 'required|exists:sub_categories,id',
            'brand'            => 'nullable|string|max:255',
            'status'           => 'required|in:0,1',

            // Thumbnail: The thumbnail is required during creation but should be nullable during updates.
            'thumbnail'        => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
                'max:2048'
            ],

            // Gallery Images: The gallery images must always be an array, and each file within the array must be an image.
            'product_images'   => 'nullable|array',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Removed Images Tracking (Optional validation)
            'removed_product_images' => 'nullable|string',
            'removed_thumbnail'      => 'nullable|string',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required'             => 'The product name is required.',
            'name.unique'               => 'The product is already created.',
            'name.string'               => 'The product name must be a string.',
            'name.max'                  => 'The product name must not exceed 255 characters.',
            'slug.string'               => 'The product slug must be a string.',
            'slug.max'                  => 'The product slug must not exceed 255 characters.',
            'shortDescription.required' => 'The product short description is required.',
            'shortDescription.string'   => 'The product short description must be a string.',
            'shortDescription.max'      => 'The product short description must not exceed 500 characters.',
            'description.string'        => 'The product description must be a string.',
            'description.max'           => 'The product description must not exceed 1000 characters.',
            'additional_info.string'    => 'The product additional information must be a string.',
            'additional_info.max'       => 'The product additional information must not exceed 1000 characters.',
            'buy_price.required'        => 'The product buy price is required.',
            'buy_price.numeric'         => 'The product buy price must be a number.',
            'buy_price.min'             => 'The product buy price must be at least 0.',
            'price.required'            => 'The product price is required.',
            'price.numeric'             => 'The product price must be a number.',
            'price.min'                 => 'The product price must be at least 0.',
            'discounted_price.numeric'  => 'The product discounted price must be a number.',
            'discounted_price.min'      => 'The product discounted price must be at least 0.',
            'discounted_price.lt'       => 'The product discounted price must be less than the product price.',
            'sku.required'              => 'The product SKU is required.',
            'sku.string'                => 'The product SKU must be a string.',
            'sku.max'                   => 'The product SKU must not exceed 255 characters.',
            'stock_quantity.required'   => 'The product stock quantity is required.',
            'stock_quantity.integer'    => 'The product stock quantity must be an integer.',
            'stock_quantity.min'        => 'The product stock quantity must be at least 0.',
            'category.required'         => 'The product category is required.',
            'category.exists'           => 'The product category does not exist.',
            'subCategory.required'      => 'The product sub-category is required.',
            'subCategory.exists'        => 'The product sub-category does not exist.',
            'brand.string'              => 'The product brand must be a string.',
            'brand.max'                 => 'The product brand must not exceed 255 characters.',
            'product_images.*.mimes' => 'Only JPEG, PNG, JPG, GIF, SVG, WEBP images are allowed.',
            'thumbnail.mimes'        => 'Only JPEG, PNG, JPG, GIF, SVG images are allowed.',
        ];
    }
}
