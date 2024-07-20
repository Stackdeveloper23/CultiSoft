<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductsFactory extends Factory
{
    protected $model = Products::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Genera una palabra para el nombre del producto
            'status' => $this->faker->randomElement(['available', 'out of stock']), // Genera un estado aleatorio
            'description' => $this->faker->paragraph, // Genera un párrafo para la descripción
            'price' => $this->faker->randomFloat(2, 5, 100), // Genera un precio entre 5 y 100
            'image_path' => $this->faker->imageUrl(), // Genera una URL de imagen
            'quantity' => $this->faker->numberBetween(1, 100), // Genera una cantidad entre 1 y 100
            'category_id' => $this->faker->numberBetween(1, 10), // Genera un ID de categoría entre 1 y 10 (ajusta según tus categorías)
        ];
    }
}
