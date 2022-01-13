<?php

namespace App\Repository;

interface AssignPromotionCodeRepositoryInterface
{
    public function userCodeCheck(int $userId, int $codeId);
    public function codeUsedCount($codeId);
}
