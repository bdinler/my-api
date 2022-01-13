<?php

namespace App\Repository;

interface PromotionCodesRepositoryInterface
{
    public function getAll();
    public function codeFind(string $code);
}
