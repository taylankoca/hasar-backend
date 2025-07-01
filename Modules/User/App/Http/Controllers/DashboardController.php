<?php

namespace Modules\User\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/dashboard",
     *   summary="Get dashboard data",
     *   tags={"Dashboard"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="startDate",
     *     in="query",
     *     schema={"type":"string","format":"date"},
     *     description="Filter data from this date."
     *   ),
     *   @OA\Parameter(
     *     name="endDate",
     *     in="query",
     *     schema={"type":"string","format":"date"},
     *     description="Filter data up to this date."
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Aggregated dashboard data",
     *     @OA\JsonContent(
     *       @OA\Property(property="summary", ref="#/components/schemas/DashboardSummary"),
     *       @OA\Property(property="performanceChart", ref="#/components/schemas/PerformanceChartData"),
     *       @OA\Property(property="paymentMethodsChart", ref="#/components/schemas/PaymentMethodsChartData")
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        // ...
        return response()->json([
            'summary' => [
                'pending' => ['amount' => 1000.0, 'count' => 3],
                'paid' => ['amount' => 5000.0, 'count' => 10],
                'overdue' => ['amount' => 200.0, 'count' => 1],
            ],
            'performanceChart' => [
                ['status' => 'Pending', 'total' => 1000.0],
                ['status' => 'Paid', 'total' => 5000.0],
                ['status' => 'Overdue', 'total' => 200.0],
            ],
            'paymentMethodsChart' => [
                ['name' => 'Credit Card', 'count' => 7],
                ['name' => 'PayPal', 'count' => 2],
                ['name' => 'Bank Transfer', 'count' => 5],
            ],
        ]);
    }
} 