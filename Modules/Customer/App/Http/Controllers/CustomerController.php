<?php

namespace Modules\Customer\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Customer\App\Services\CustomerService;

class CustomerController extends Controller
{
    protected $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/customers",
     *     summary="Get all customers",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Fuzzy search term for customers.",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="startDate",
     *         in="query",
     *         description="Filter customers created from this date.",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="endDate",
     *         in="query",
     *         description="Filter customers created up to this date.",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of customers",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Customer"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = $this->service->getAllCustomers();
        if ($search = $request->query('search')) {
            $query = $query->filter(function($item) use ($search) {
                return str_contains(strtolower($item->name), strtolower($search)) ||
                       str_contains(strtolower($item->surname ?? ''), strtolower($search)) ||
                       str_contains(strtolower($item->email), strtolower($search));
            });
        }
        if ($startDate = $request->query('startDate')) {
            $query = $query->where('createdAt', '>=', $startDate);
        }
        if ($endDate = $request->query('endDate')) {
            $query = $query->where('createdAt', '<=', $endDate);
        }
        return response()->json($query->values());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * @OA\Post(
     *     path="/api/customers",
     *     summary="Create a new customer",
     *     tags={"Customers"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CustomerInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->only(['customerType', 'name', 'surname', 'email', 'phone', 'address', 'tckn', 'vkn', 'createdAt']);
        $customer = $this->service->createCustomer($data);
        return response()->json($customer, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($email)
    {
        $customer = $this->service->getAllCustomers()->where('email', $email)->first();
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('customer::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $email)
    {
        $customer = $this->service->getAllCustomers()->where('email', $email)->first();
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->update($request->only([
            'customerType', 'name', 'surname', 'phone', 'address', 'tckn', 'vkn', 'createdAt'
        ]));
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($email)
    {
        $customer = $this->service->getAllCustomers()->where('email', $email)->first();
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->delete();
        return response()->json(null, 204);
    }
}
