<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estadofactura;
use App\Models\Factura;
use App\Models\Formapago;
use App\Models\Pedido;
use App\Models\Perfil;
use App\Models\Producto;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'perfiles' => Perfil::count(),
            'usuarios' => User::count(),
            'clientes' => Cliente::count(),
            'formas_pago' => Formapago::count(),
            'estados_factura' => Estadofactura::count(),
            'facturas' => Factura::count(),
            'productos' => Producto::count(),
            'pedidos' => Pedido::count(),
            'facturacion_total' => (float) Factura::sum('valor'),
            'inventario_total' => (int) Producto::sum('cantidad'),
            'monto_pedidos' => (float) Pedido::sum('precio'),
        ];

        $tablas = [
            'perfiles' => Perfil::query()
                ->orderBy('id')
                ->get(['id', 'nombre']),
            'usuarios' => User::query()
                ->with('perfil:id,nombre')
                ->orderByDesc('id')
                ->take(8)
                ->get(['id', 'name', 'email', 'idperfil', 'created_at']),
            'clientes' => Cliente::query()
                ->orderByDesc('id')
                ->take(8)
                ->get(['id', 'nombre', 'rfc', 'telefono', 'email']),
            'formas_pago' => Formapago::query()
                ->orderBy('id')
                ->get(['id', 'nombre']),
            'estados_factura' => Estadofactura::query()
                ->orderBy('id')
                ->get(['id', 'estado']),
            'facturas' => Factura::query()
                ->with(['cliente:id,nombre,rfc', 'forma:id,nombre', 'estado:id,estado'])
                ->orderByDesc('id')
                ->take(8)
                ->get(['id', 'numero', 'valor', 'idCliente', 'idforma', 'idestado']),
            'productos' => Producto::query()
                ->orderByDesc('id')
                ->take(8)
                ->get(['id', 'nombre', 'precio', 'cantidad']),
            'pedidos' => Pedido::query()
                ->orderByDesc('id')
                ->take(8)
                ->get(['id', 'nombre', 'cantidad', 'precio']),
        ];

        return view('dashboard', compact('stats', 'tablas'));
    }
}
