<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate(Request $request)
    {
        $data = [
            'to' => 'Sam Example',
            'subtotal' => '5.00',
            'tax' => '.35',
            'total' => '5.35'
        ];

        # Optional: Append ?preview to the URL to preview the output directly in the browser instead of downloading the PDF
        if($request->has('preview')) {
            $data['css'] = 'css/invoice.css';
            return view('invoice', $data);
        } else {
            $data['css'] = public_path('css/invoice.css');
        }

        $pdf = Pdf::loadView('invoice', $data)->setPaper('a4', 'portrait');

        # Option 1) Show the PDF in the browser
        return $pdf->stream();

        # Option 2) Download the PDF
        // return $pdf->download('invoice.pdf');
    }
}
