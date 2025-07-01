<?php

namespace Modules\Customer\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerImportExportController extends Controller
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
            \Modules\Customer\App\Models\Customer::updateOrCreate(
                ['email' => $data['email']],
                [
                    'customerType' => $data['customerType'] ?? 'Bireysel',
                    'name' => $data['name'] ?? '',
                    'surname' => $data['surname'] ?? null,
                    'phone' => $data['phone'] ?? '',
                    'address' => $data['address'] ?? '',
                    'createdAt' => $data['createdAt'] ?? null,
                    'tckn' => $data['tckn'] ?? null,
                    'vkn' => $data['vkn'] ?? null,
                ]
            );
            $count++;
        }
        fclose($handle);
        return response()->json(['message' => "Imported $count customers"]);
    }

    public function export(Request $request)
    {
        $ids = $request->query('ids', []);
        $customers = $ids ? \Modules\Customer\App\Models\Customer::whereIn('email', $ids)->get() : \Modules\Customer\App\Models\Customer::all();
        $csv = "email,name,surname,customerType\n";
        foreach ($customers as $c) {
            $csv .= "{$c->email},{$c->name},{$c->surname},{$c->customerType}\n";
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="customers.csv"',
        ]);
    }
} 