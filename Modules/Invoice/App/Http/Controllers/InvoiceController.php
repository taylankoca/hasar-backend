<?php

namespace Modules\Invoice\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Invoice\App\Services\InvoiceService;

class InvoiceController extends Controller
{
    protected $service;

    public function __construct(InvoiceService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *   path="/api/invoices",
     *   summary="Get all invoices",
     *   tags={"Invoices"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="search",
     *     in="query",
     *     description="Fuzzy search term for invoices.",
     *     required=false,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="startDate",
     *     in="query",
     *     description="Filter invoices with due date from this date.",
     *     required=false,
     *     @OA\Schema(type="string", format="date")
     *   ),
     *   @OA\Parameter(
     *     name="endDate",
     *     in="query",
     *     description="Filter invoices with due date up to this date.",
     *     required=false,
     *     @OA\Schema(type="string", format="date")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="A list of invoices",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Invoice"))
     *   )
     * )
     */
    public function index(Request $request)
    {
        $query = $this->service->getAllInvoices();
        if ($search = $request->query('search')) {
            $query = $query->filter(function($item) use ($search) {
                return str_contains(strtolower($item->invoiceNo), strtolower($search)) ||
                       str_contains(strtolower($item->name), strtolower($search)) ||
                       str_contains(strtolower($item->surname ?? ''), strtolower($search));
            });
        }
        if ($startDate = $request->query('startDate')) {
            $query = $query->where('dueDate', '>=', $startDate);
        }
        if ($endDate = $request->query('endDate')) {
            $query = $query->where('dueDate', '<=', $endDate);
        }
        return response()->json($query->values());
    }

    /**
     * @OA\Post(
     *   path="/api/invoices",
     *   summary="Create a new invoice",
     *   tags={"Invoices"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/InvoiceInput")
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Invoice created",
     *     @OA\JsonContent(ref="#/components/schemas/Invoice")
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->only(['customer_id', 'amount', 'status', 'issued_at']);
        $invoice = $this->service->createInvoice($data);
        return response()->json($invoice, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $invoice = $this->service->getInvoice($id);
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        return response()->json($invoice);
    }

    /**
     * Show the specified resource with customer.
     */
    public function showWithCustomer($id)
    {
        $result = $this->service->getInvoiceWithCustomer($id);
        if (!$result) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('invoice::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @OA\Get(
     *   path="/api/invoices/{invoiceNo}",
     *   summary="Get an invoice by number",
     *   tags={"Invoices"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="invoiceNo",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Invoice details",
     *     @OA\JsonContent(ref="#/components/schemas/Invoice")
     *   ),
     *   @OA\Response(response=404, description="Invoice not found")
     * )
     */
    public function showByNo($invoiceNo)
    {
        $invoice = $this->service->getAllInvoices()->where('invoiceNo', $invoiceNo)->first();
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        return response()->json($invoice);
    }

    /**
     * @OA\Put(
     *   path="/api/invoices/{invoiceNo}",
     *   summary="Update an invoice",
     *   tags={"Invoices"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="invoiceNo",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/InvoiceUpdateInput")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Invoice updated",
     *     @OA\JsonContent(ref="#/components/schemas/Invoice")
     *   ),
     *   @OA\Response(response=404, description="Invoice not found")
     * )
     */
    public function updateByNo(Request $request, $invoiceNo)
    {
        $invoice = $this->service->getAllInvoices()->where('invoiceNo', $invoiceNo)->first();
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        $invoice->update($request->only([
            'customerKey', 'name', 'surname', 'amount', 'dueDate', 'paymentType', 'status'
        ]));
        return response()->json($invoice);
    }

    /**
     * @OA\Delete(
     *   path="/api/invoices/{invoiceNo}",
     *   summary="Delete an invoice",
     *   tags={"Invoices"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="invoiceNo",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=204, description="Invoice deleted"),
     *   @OA\Response(response=404, description="Invoice not found")
     * )
     */
    public function destroyByNo($invoiceNo)
    {
        $invoice = $this->service->getAllInvoices()->where('invoiceNo', $invoiceNo)->first();
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        $invoice->delete();
        return response()->json(null, 204);
    }
}
