<?php

namespace App\Http\Controllers;


use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Models\User;
use App\Service\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();
        $user = User::where('email',$request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $apiToken = Str::random(60);
                $user->update(['api_token' => $apiToken]);

                return $this->successMessage([
                    'user_id' => $user->id,
                    'token' => $apiToken,
                ]);
            } else {
                return $this->errorMessage(trans('auth.password'),401);
            }
        } else {
            return $this->errorMessage(trans('auth.failed'),401);
        }
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $registerInputs = $request->validated();
        $user = $this->userService->register($registerInputs);
        return $this->successMessage([
            'token' => $user->api_token,
            'user_id' => $user->id
        ], trans('auth.registerSuccess'));
    }
}
