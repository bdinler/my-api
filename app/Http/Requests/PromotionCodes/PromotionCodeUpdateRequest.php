<?php

namespace App\Http\Requests\PromotionCodes;

use Illuminate\Foundation\Http\FormRequest;

class PromotionCodeUpdateRequest extends FormRequest
{

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:1'],
            'quota' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date']
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
            'amount' => 'Amount',
            'quota' => 'Quota',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }
}
