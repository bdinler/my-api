<?php

namespace App\Service;

interface AssignPromotionCodeServiceInterface
{
    public function assign(array $data, int $userId);
    public function codeUsedCount(int $codeId);
}
