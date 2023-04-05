<?php

namespace App\Http\Requests\Vendors\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'image' => ['required', 'image','mimes:jpg,png,jpeg'],
            'color' => ['nullable'],
            'size' => ['nullable']
        ];
    }
}
