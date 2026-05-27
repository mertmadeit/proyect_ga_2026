<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Formapago;
use App\Models\Estadofactura;
use Barryvdh\DomPDF\Facade\Pdf;
class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::query()
            ->with(['cliente', 'forma', 'estado'])
            ->paginate(10);
        return view('Facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = Estadofactura::orderBy('estado', 'asc')->pluck('estado', 'id');
        return view('Facturas.crear', compact('clientes', 'formas', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'valor' => ['required', 'numeric'],
            'detalles' => ['required', 'string'],
            'idcliente' => ['required', 'integer', 'exists:clientes,id'],
            'idforma' => ['required', 'integer', 'exists:formaspago,id'],
            'idestado' => ['required', 'integer', 'exists:estadosfacturas,id'],
        ]);

        $numero = (int) (Factura::max('numero') ?? 0) + 1;

		$factura = new Factura();
        $factura->numero = $numero;
		$factura->detalles = $validated['detalles'];
		$factura->valor = $validated['valor'];
		$factura->archivo = '';
		$factura->idCliente = $validated['idcliente'];
		$factura->idforma = $validated['idforma'];
		$factura->idestado = $validated['idestado'];
		$factura->save();

        $pdfGenerado = false;
        try {
            $cliente = Cliente::find($factura->idCliente, ['*']);
            $forma = Formapago::find($factura->idforma, ['*']);
            $estado = Estadofactura::find($factura->idestado, ['*']);
            $fechaEmision = now()->format('Y-m-d H:i');

            $pdf = Pdf::loadView('Facturas.pdf', compact('factura', 'cliente', 'forma', 'estado', 'fechaEmision'));
            $nombrePdf = "factura-{$factura->numero}-{$factura->id}.pdf";

            if (!is_dir(public_path('archivos'))) {
                mkdir(public_path('archivos'), 0755, true);
            }

            Storage::disk('archivos')->put($nombrePdf, $pdf->output());
            $factura->archivo = $nombrePdf;
            $factura->save();
            $pdfGenerado = true;
        } catch (\Throwable $e) {
            Log::error('No se pudo generar el PDF de la factura.', [
                'factura_id' => $factura->id,
                'numero' => $factura->numero,
                'error' => $e->getMessage(),
            ]);
        }

        $mensaje = $pdfGenerado
            ? 'Factura creada y PDF generado exitosamente.'
            : 'Factura creada, pero no se pudo generar el PDF.';

        return redirect()->route('facturas.index')->with('success', $mensaje);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $factura = Factura::findOrFail($id);
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = Estadofactura::orderBy('estado', 'asc')->pluck('estado', 'id');
        return view('Facturas.editar', compact('factura', 'clientes', 'formas', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $factura = Factura::findOrFail($id);

        $validated = $request->validate([
            'valor' => ['required', 'numeric'],
            'detalles' => ['required', 'string'],
            'idcliente' => ['required', 'integer', 'exists:clientes,id'],
            'idforma' => ['required', 'integer', 'exists:formaspago,id'],
            'idestado' => ['required', 'integer', 'exists:estadosfacturas,id'],
        ]);

        $factura->detalles = $validated['detalles'];
        $factura->valor = $validated['valor'];
        $factura->idCliente = $validated['idcliente'];
        $factura->idforma = $validated['idforma'];
        $factura->idestado = $validated['idestado'];
        $factura->save();

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura = Factura::findOrFail($id);

		if (!empty($factura->archivo) && Storage::disk('archivos')->exists($factura->archivo)) {
			Storage::disk('archivos')->delete($factura->archivo);
		}

        $factura->delete();

        return redirect()->route('facturas.index');
    }
}
