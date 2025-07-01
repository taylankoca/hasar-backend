<?php

namespace Modules\Invoice\App\Services;

use Modules\Invoice\App\Repositories\InvoiceRepository;
use Modules\Customer\App\Services\CustomerService;

class InvoiceService
{
    protected $repository;
    protected $customerService;

    public function __construct(InvoiceRepository $repository, CustomerService $customerService)
    {
        $this->repository = $repository;
        $this->customerService = $customerService;
    }

    public function getAllInvoices()
    {
        return $this->repository->all();
    }

    public function getInvoice($id)
    {
        return $this->repository->find($id);
    }

    public function createInvoice(array $data)
    {
        return $this->repository->create($data);
    }

    public function getInvoiceWithCustomer($invoiceId)
    {
        $invoice = $this->repository->find($invoiceId);
        if (!$invoice) {
            return null;
        }
        $customer = $this->customerService->getCustomer($invoice->customer_id);
        return [
            'invoice' => $invoice,
            'customer' => $customer,
        ];
    }
} 