<?php

namespace Database\Factories;

use App\Models\PromotionCodes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignedPromotionCodesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::where('role', '!=', 'admin')->get()->random()->id,
            'code_id' => PromotionCodes::all()->random()->id
        ];
    }
}
