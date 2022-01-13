<?php

namespace Database\Seeders;

use App\Models\AssignedPromotionCodes;
use App\Models\PromotionCodes;
use App\Models\User;
use App\Models\Wallets;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'admin',
            'username' => 'admin',
            'firstname' => 'Demo',
            'lastname' => 'Admin',
            'email' => 'admin@demo.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Wallets::factory(1000)->create();
        PromotionCodes::factory(100)->create();
        AssignedPromotionCodes::factory(1000)->create()->each(function ($assignedPromotionCode){
            $promotionCode = PromotionCodes::find($assignedPromotionCode->code_id);
            $userWallet = Wallets::where('user_id', $assignedPromotionCode->user_id)->first();
            $newBalance = $userWallet->balance + $promotionCode->amount;
            $userWallet->balance = $newBalance;
            $userWallet->save();
        });
    }
}
