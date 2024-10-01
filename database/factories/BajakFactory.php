<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bajak>
 */
class BajakFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $platGroup = ['PG1', 'PG2', 'PG3'];

    return [
      'PlantGroup' => $this->faker->randomElement($platGroup),
      'TGL_Pengamatan' => $this->faker->date('d-M-y'),
      'Lokasi' => $this->faker->randomNumber(3) . $this->faker->randomLetter() . $this->faker->randomNumber(1),
      'Luas' => $this->faker->randomFloat(2, 0, 15),
      'Sat' => $this->faker->randomElement(['HA']),
      'Exs_Tanaman' => 'Nanas',
      'Kedalaman%MasukSTD' => $this->faker->randomFloat(2, 70, 100),
      'Kedalaman(Min)' => $this->faker->randomFloat(2, 70, 100),
      'Kedalaman(Max)' => $this->faker->randomFloat(2, 70, 100),
      'Kedalaman(Rata-Rata)' => $this->faker->randomFloat(2, 70, 100),
      'Aplikasi_pinggiran%MasukSTD' => $this->faker->randomFloat(2, 70, 100),
      'Kerataan_Aplikasi%MasukSTD' => $this->faker->randomFloat(2, 70, 100),
      'Total(%)' => $this->faker->randomFloat(2, 70, 100),
      'Jenis Bajak' => $this->faker->randomElement(['Dangkal', 'Dalam']),
      'Comoditi' => $this->faker->randomElement(['Nanas', 'Singkong']),
    ];
  }
}
