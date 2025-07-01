<?php

namespace Modules\Customer\App\Services;

use Modules\Customer\App\Repositories\CustomerRepository;

class CustomerService
{
    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCustomers()
    {
        return $this->repository->all();
    }

    public function getCustomer($id)
    {
        return $this->repository->find($id);
    }

    public function createCustomer(array $data)
    {
        return $this->repository->create($data);
    }
} 