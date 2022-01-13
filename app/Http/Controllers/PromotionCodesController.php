<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionCodes\PromotionCodeStoreRequest;
use App\Http\Requests\PromotionCodes\PromotionCodeUpdateRequest;
use App\Service\AssignPromotionCodeService;
use App\Service\PromotionCodesServiceInterface;
use Illuminate\Http\JsonResponse;

class PromotionCodesController extends Controller
{
    /**
     * @var PromotionCodesServiceInterface
     */
    private $promotionCodesService;

    /**
     * @var AssignPromotionCodeService
     */
    private $assignPromotionCodeService;

    public function __construct(PromotionCodesServiceInterface $promotionCodesService, AssignPromotionCodeService $assignPromotionCodeService)
    {
        $this->promotionCodesService = $promotionCodesService;
        $this->assignPromotionCodeService = $assignPromotionCodeService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
       $results = $this->promotionCodesService->getAll();
       return $this->successMessage($results, trans('promotion.listed'));
    }

    /**
     * @param PromotionCodeStoreRequest $request
     * @return JsonResponse
     */
    public function store(PromotionCodeStoreRequest $request): JsonResponse
    {
        $inputs = $request->validated();
        $promotionCode = $this->promotionCodesService->create($inputs);
        return $this->successMessage($promotionCode, trans('promotion.created'));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $promotionCode = $this->promotionCodesService->show($id);
        if(!$promotionCode) {
            return $this->errorMessage(trans('promotion.notFound'),401);
        }
        return $this->successMessage($promotionCode);
    }

    /**
     * @param PromotionCodeUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PromotionCodeUpdateRequest $request, int $id): JsonResponse
    {
        $promotionCodeFind = $this->promotionCodesService->find($id);
        if(!$promotionCodeFind) {
            return $this->errorMessage(trans('promotion.notFound'),401);
        }
        
        $inputs = $request->validated();
        $promotionCode = $this->promotionCodesService->update($inputs, $id);
        return $this->successMessage($promotionCode);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $codeUsedCount = $this->assignPromotionCodeService->codeUsedCount($id);
        if($codeUsedCount > 0){
            return $this->errorMessage(trans('promotion.connotDeleted'),401);
        }

        $promotionCode = $this->promotionCodesService->delete($id);
        if(! $promotionCode){
            return $this->errorMessage(trans('promotion.notFound'),401);
        }
        return $this->successMessage(null, trans('promotion.deleted'));
    }
}
