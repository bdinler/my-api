<?php

namespace App\Repository\Eloquent;

use App\Models\AssignedPromotionCodes;
use App\Repository\AssignPromotionCodeRepositoryInterface;

class AssignPromotionCodeRepositoryRepository extends BaseRepository implements AssignPromotionCodeRepositoryInterface
{

    /**
     * @param AssignedPromotionCodes $model
     */
    public function __construct(AssignedPromotionCodes $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param int $codeId
     * @return mixed
     */
    public function userCodeCheck(int $userId, int $codeId)
    {
       return $this->model->where('user_id', $userId)->where('code_id', $codeId)->first();
    }

    /**
     * @param $codeId
     * @return mixed
     */
    public function codeUsedCount($codeId)
    {
        return $this->model->where('code_id', $codeId)->count();
    }
}
