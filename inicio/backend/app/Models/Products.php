<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id']; // Campos fillable según tu estructura

    // Relación pertenencia a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
