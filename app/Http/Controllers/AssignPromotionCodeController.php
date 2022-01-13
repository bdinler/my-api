<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignPromotion\AssignPromotionRequest;
use App\Service\AssignPromotionCodeServiceInterface;
use Illuminate\Http\JsonResponse;

class AssignPromotionCodeController extends Controller
{
    /**
     * @var AssignPromotionCodeServiceInterface
     */
    private $assignPromotionCodeService;

    public function __construct(AssignPromotionCodeServiceInterface $assignPromotionCodeService)
    {
        $this->assignPromotionCodeService = $assignPromotionCodeService;
    }

    /**
     * @param AssignPromotionRequest $request
     * @return JsonResponse
     */
    public function assign(AssignPromotionRequest $request): JsonResponse
    {
        $codeInput = $request->validated();
        return $this->assignPromotionCodeService->assign($codeInput, $request->user()->id);
    }
}
