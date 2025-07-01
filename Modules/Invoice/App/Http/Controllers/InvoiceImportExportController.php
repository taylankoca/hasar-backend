<?php

namespace Modules\Invoice\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvoiceImportExportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        if (!$file) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);
        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            \Modules\Invoice\App\Models\Invoice::updateOrCreate(
                ['invoiceNo' => $data['invoiceNo']],
                [
                    'customerKey' => $data['customerKey'] ?? '',
                    'name' => $data['name'] ?? '',
                    'surname' => $data['surname'] ?? null,
                    'amount' => $data['amount'] ?? 0,
                    'dueDate' => $data['dueDate'] ?? null,
                    'paymentType' => $data['paymentType'] ?? 'Credit Card',
                    'status' => $data['status'] ?? 'Pending',
                ]
            );
            $count++;
        }
        fclose($handle);
        return response()->json(['message' => "Imported $count invoices"]);
    }

    public function export(Request $request)
    {
        $ids = $request->query('ids', []);
        $invoices = $ids ? \Modules\Invoice\App\Models\Invoice::whereIn('invoiceNo', $ids)->get() : \Modules\Invoice\App\Models\Invoice::all();
        $csv = "invoiceNo,name,surname,amount,status\n";
        foreach ($invoices as $i) {
            $csv .= "{$i->invoiceNo},{$i->name},{$i->surname},{$i->amount},{$i->status}\n";
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="invoices.csv"',
        ]);
    }
} 