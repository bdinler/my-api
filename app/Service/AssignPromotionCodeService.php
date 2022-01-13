<?php

namespace App\Service;

use App\Repository\AssignPromotionCodeRepositoryInterface;
use App\Repository\PromotionCodesRepositoryInterface;
use App\Repository\WalletRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AssignPromotionCodeService extends BaseService implements AssignPromotionCodeServiceInterface
{
    /**
     * @var AssignPromotionCodeRepositoryInterface
     */
    private $assignPromotionCodeRepository;

    /**
     * @var PromotionCodesRepositoryInterface
     */
    private $promotionCodesRepository;

    /**
     * @var WalletRepositoryInterface
     */
    private $walletRepository;

    public function __construct(
        AssignPromotionCodeRepositoryInterface $assignPromotionCodeRepository,
        PromotionCodesRepositoryInterface $promotionCodesRepository,
        WalletRepositoryInterface $walletRepository
    )
    {
        $this->assignPromotionCodeRepository = $assignPromotionCodeRepository;
        $this->promotionCodesRepository = $promotionCodesRepository;
        $this->walletRepository = $walletRepository;
    }

    /**
     * @param array $data
     * @param int $userId
     * @return JsonResponse
     */
    public function assign(array $data, int $userId): JsonResponse
    {
        $error = false;
        $promotionCode = $this->promotionCodesRepository->codeFind($data['code']);

        if (!$promotionCode) {
            $error = $this->errorMessage(trans('promotion.invalid'), 401);
        } elseif ($promotionCode->start_date > now()) {
            $error = $this->errorMessage(
                trans(
                    'promotion.invalidDateRange',
                    [
                        'start_date' => $promotionCode->start_date,
                        'end_date' => $promotionCode->end_date
                    ]
                ),
                401
            );
        } elseif ($promotionCode->end_date < now()) {
            $error = $this->errorMessage(trans('promotion.expired'), 401);
        }

        if($error) {
            return $error;
        }

        $assignedPromotionCode = $this->assignPromotionCodeRepository->userCodeCheck($userId, $promotionCode->id);

        if($assignedPromotionCode){
            return $this->errorMessage(trans('promotion.used'),401);
        }

        $usedCodeCount = $this->codeUsedCount($promotionCode->id);
        if($usedCodeCount >= $promotionCode->quota){
            return $this->errorMessage(trans('promotion.quota'),401);
        }

        $userWallet = $this->walletRepository->userWallet($userId);
        $balance = $userWallet->balance + $promotionCode->amount;
        $this->walletRepository->updateOrCreate(['user_id' => $userId, 'balance' => $balance]);
        $this->assignPromotionCodeRepository->create(['user_id' => $userId, 'code_id' => $promotionCode->id]);

        return $this->successMessage(null, trans('promotion.success'));
    }

    /**
     * @param int $codeId
     * @return mixed
     */
    public function codeUsedCount(int $codeId)
    {
        return $this->assignPromotionCodeRepository->codeUsedCount($codeId);
    }

}
