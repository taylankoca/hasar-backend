<?php

namespace Modules\User\App\Services;

use Modules\User\App\Repositories\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers()
    {
        return $this->repository->all();
    }

    public function getUser($id)
    {
        return $this->repository->find($id);
    }

    public function createUser(array $data)
    {
        return $this->repository->create($data);
    }
} 