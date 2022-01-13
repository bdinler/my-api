<?php

namespace App\Service;

use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function register(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);
        $data['api_token'] = Str::random(60);
        return $this->userRepository->create($data);
    }
}
