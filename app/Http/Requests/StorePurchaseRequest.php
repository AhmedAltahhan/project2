<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
        return [
            'purchase' => ['nullable', 'exists:purchases,id'],
            'user_id' => ['required_without:purchase'],
            'purchaseable_type' => ['required_without:purchase','in:App\Models\Package,App\Models\Course'],
            'purchaseable_id' => ['required_without:purchase','numeric'],
        ];
    }
}
