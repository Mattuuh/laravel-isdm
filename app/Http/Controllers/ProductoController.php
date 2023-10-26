<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Requests\Validacion;

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
    public function validar(Validacion $request)
    {
        // Verificar si la validación ha pasado
        if ($request->validated()) {
            // Los datos del formulario se han validado correctamente           
            return "Los datos del formulario son válidos.";
        }
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('panel.vendedor.lista_productos.edit', compact('producto', 'categorias'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        $producto->categoria_id = $request->get('categoria_id');

        if ($request->hasFile('imagen')) {
            // Subida de la imagen nueva al servidor
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen = asset(str_replace('public','storage',$image_url));
        }

        // Actualiza la info del producto en la BD
        $producto->update();
        return redirect()
        ->route('producto.index')
        ->with('alert','Producto "' . $producto->nombre . '" actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()
        ->route('producto.index')
        ->with('alert','Producto eliminado exitosamente.');
    }
}
