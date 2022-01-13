<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionCodesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $quota = [50,60,70,80,90,100];
        $amount = [200,300,400,500];
        $startDate = $this->faker->dateTimeBetween('-1 month', '+2 weeks');
        $endDate = $this->faker->dateTimeBetween($startDate->format('Y-m-d H:i:s') . ' +2 days', $startDate->format('Y-m-d H:i:s').' +2 weeks');
        return [
            'code' => $this->faker->unique->regexify('[A-Za-z0-9]{10}'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'amount' => $amount[array_rand($amount)],
            'quota' =>$quota[array_rand($quota)]
        ];
    }
}
