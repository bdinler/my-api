<?php

namespace App\Http\Middleware;

use App\Traits\Responder;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class ApiToken
{
    use Responder;

    /**
     * @param Request $request
     * @param Closure $next
     * @param ...$roles
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        $auth = $request->header('Authorization');
        if ($auth) {
            $token = str_replace('Bearer ', '', $auth);
            if (!$token) {
                return $this->errorMessage(trans('messages.userInvalid'), 401);
            }

            $user = User::where('api_token', $token)->first();
            if (!$user) {
                return $this->errorMessage(trans('messages.userNotFound'), 401);
            }
            if(!in_array($user->role, $roles)){
                return $this->errorMessage(trans('messages.unauthorized'), 401);
            }
            auth()->setUser($user);
            return $next($request);
        }
        return $this->errorMessage(trans('messages.tokenInvalid'), 403);
    }
}
