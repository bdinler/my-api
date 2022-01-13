<?php

namespace App\Repository\Eloquent;

use App\Models\PromotionCodes;
use App\Repository\PromotionCodesRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PromotionCodesRepository extends BaseRepository implements PromotionCodesRepositoryInterface
{
    /**
     * @param PromotionCodes $model
     */
    public function __construct(PromotionCodes $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return $this->model->with('users')->get();
    }

    public function update($data)
    {
        return $this->model->find($data['id'])->update($data);
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function codeFind(string $code)
    {
        return $this->model->where('code',$code)->first();
    }
}
