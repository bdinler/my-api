<?php

namespace App\Http\Requests\AssignPromotion;

use Illuminate\Foundation\Http\FormRequest;

class AssignPromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return (auth()->user()->role == 'user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:15']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'code' => 'Promotion Code'
        ];
    }
}
