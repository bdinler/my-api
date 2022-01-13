<?php

namespace App\Repository;

interface WalletRepositoryInterface
{
    public function userWallet(int $userId);
    public function updateOrCreate(array $data);
}
