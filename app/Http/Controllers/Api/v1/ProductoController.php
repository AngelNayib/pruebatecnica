<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProductoRequest as StorePro;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return responseJson(200, 'ok', Product::with('category')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePro $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileUrl = Storage::disk('public')->put('images', $file);
            }

            $producto = Product::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'image' => 'storage/' . $fileUrl,
                'category_id' => $request->category_id
            ]);
            DB::commit();
            return responseJson(200, 'ok', $producto);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson(500, 'error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with('category')->find($id);
            if (!$product) {
                return responseJson(404, 'not found', 'product not found');
            }
            return responseJson(200, 'ok', $product);
        } catch (\Exception $e) {
            return responseJson(500, 'error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileUrl = Storage::disk('public')->put('images', $file);
            }

            $product = Product::find($id);
            $product->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'image' => 'storage/' . $fileUrl,
                'category_id' => $request->category_id
            ]);
            DB::commit();
            return responseJson(200, 'ok', $product);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson(500, 'error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->delete();
            DB::commit();
            return responseJson(200, 'ok', $product);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson(500, 'error', $e->getMessage());
        }
    }
}
