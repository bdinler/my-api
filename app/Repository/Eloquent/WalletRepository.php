<?php

namespace App\Repository\Eloquent;

use App\Models\Wallets;
use App\Repository\WalletRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class WalletRepository extends BaseRepository implements WalletRepositoryInterface
{
    /**
     * @param Wallets $model
     */
    public function __construct(Wallets $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @return Model
     */
    public function userWallet(int $userId): Model
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(array $data)
    {
        return $this->model->updateOrCreate(
            [
                'user_id' => $data['user_id']
            ],
            $data
        );

    }
}
