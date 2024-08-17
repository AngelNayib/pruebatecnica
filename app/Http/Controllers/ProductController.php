<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {

        return view('producto.index', [
            'productos' => Product::orderBy('created_at', 'asc')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('producto.create', [
            'categorias' => Category::all()
        ]);
    }

    public function store(StoreProductoRequest $request)
    {
        try {
            DB::beginTransaction();
            Product::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'category_id' => $request->category_id
            ]);
            DB::commit();
            return redirect()->route('producto.index')->with('success', 'Producto creado');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('producto.create')->with('errors', $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        return view('producto.edit', [
            'producto' => $product,
            'categorias' => Category::all()
        ]);
    }

    public function update(StoreProductoRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'category_id' => $request->category_id
            ]);
            DB::commit();
            return redirect()->route('producto.index')->with('success', 'Producto actualizado');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('producto.edit', $product)->with('errors', $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product->delete();
            DB::commit();
            return redirect()->route('producto.index')->with('success', 'Producto eliminado');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('producto.index')->with('errors', $e->getMessage());
        }
    }
}
