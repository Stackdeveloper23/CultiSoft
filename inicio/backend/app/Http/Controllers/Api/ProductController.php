<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
        $products = Products::with('category')->paginate(10);
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Products::with('category')->findOrFail($id);
        return response()->json($product);
    }
}
