<?php

namespace Database\Factories\Buku;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\buku\kategori>
 */
class KategoriBukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->word(),
            'kode_kategori' => $this->faker->word(),
        ];
    }
}
