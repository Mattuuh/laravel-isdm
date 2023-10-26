<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::where('vendedor_id', auth()->user()->id) // Filtra los productos del VENDEDOR LOGUEADO
            ->latest() // Ordena de manera DESC por el campo "created_at"
            ->get(); // Convierte los datos extraidos de la BD en un Array
        // Retornamos una vista y enviamos la variable "productos"
        return view('panel.vendedor.lista_productos.index', compact('productos'));
    }
}
