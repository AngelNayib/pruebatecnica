<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Muestra la lista de productos
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        return view('producto.index', [
            'productos' => Product::orderBy('created_at', 'asc')->paginate(5)
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo producto
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.create', [
            'categorias' => Category::all()
        ]);
    }

    /**
     * Almacena un nuevo producto
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {
        try {
            DB::beginTransaction();
            //Determina si se tiene el aprametro image en la peticion validacion extra
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileUrl = Storage::disk('public')->put('images', $file);
            }

            Product::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'image' => 'storage/' . $fileUrl,
                'category_id' => $request->category_id
            ]);
            DB::commit();
            //redirige en caso de exito con variables de sesion
            return redirect()->route('producto.index')->with('success', 'Producto creado');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('producto.create')->with('errors', $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar un producto
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('producto.edit', [
            'producto' => $product,
            'categorias' => Category::all()
        ]);
    }

    /**
     * Actualiza un producto
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductoRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileUrl = Storage::disk('public')->put('images', $file);
            } //TODO: Añadir tambien else en caso de no existir imagen
            $product->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'image' => 'storage/' . $fileUrl,
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

    /**
     *  Elimina un producto
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
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
