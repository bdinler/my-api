<?php

namespace App\Service;

use App\Repository\PromotionCodesRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PromotionCodesService extends BaseService implements PromotionCodesServiceInterface
{
    /**
     * @var PromotionCodesRepositoryInterface
     */
    private $promotionCodesRepository;

    /**
     * @param PromotionCodesRepositoryInterface $promotionCodesRepository
     */
    public function __construct(PromotionCodesRepositoryInterface $promotionCodesRepository)
    {
        $this->promotionCodesRepository = $promotionCodesRepository;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->promotionCodesRepository->getAll();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function show(int $id): ?Model
    {
        $promotionCode = $this->promotionCodesRepository->find($id);
        $promotionCode->users;
        return $promotionCode;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $data['code'] = Str::random(10);
        return $this->promotionCodesRepository->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id)
    {
        $data['id'] = $id;
        return $this->promotionCodesRepository->update($data);
    }

    /**
     * Delete promotion code
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        return $this->promotionCodesRepository->delete($id);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->promotionCodesRepository->find($id);
    }
}
