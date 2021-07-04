<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceCalculatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product' => 'required|integer|exists:App\Models\ProductModel,id',
            'venue' => 'required|integer|exists:App\Models\VenueModel,id',
            'member' => 'required|integer|exists:App\Models\MemberModel,id',
        ];
    }
}
