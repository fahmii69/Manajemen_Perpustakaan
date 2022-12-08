<?php

namespace Database\Factories\Buku;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku\Penerbit>
 */
class PenerbitBukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_penerbit' => $this->faker->name(),
            'kode_penerbit' => $this->faker->unique()->randomLetter(),
        ];
    }
}
