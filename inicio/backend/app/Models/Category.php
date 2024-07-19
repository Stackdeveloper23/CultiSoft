<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Campos fillable según tu estructura

    // Relación uno a muchos con Product
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
/*
// Obtener todos los productos de una categoría
$category = Category::find($categoryId);
$products = $category->products;

// Obtener la categoría a la que pertenece un producto
$product = Product::find($productId);
$category = $product->category;*/