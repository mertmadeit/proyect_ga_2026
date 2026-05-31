<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function facturas()
    {
        $facturas = Factura::with(['cliente', 'forma', 'estado'])
            ->orderByDesc('id')
            ->get();

        $pdf = Pdf::loadView('pdfs.facturas', [
            'facturas' => $facturas,
            'fechaGeneracion' => now()->format('Y-m-d H:i:s'),
        ]);

        return $pdf->download('reporte-facturas.pdf');
    }
}
