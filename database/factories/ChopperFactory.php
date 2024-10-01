<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chopper>
 */
class ChopperFactory extends Factory
{

  protected $model = \App\Models\Chopper::class;

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
      // TanggalPengamatan format 18-Mar-21
      'TanggalPengamatan' => $this->faker->date('d-M-y'),
      // Lokasi random string like this '502D2'
      'Lokasi' => $this->faker->randomNumber(3) . $this->faker->randomLetter() . $this->faker->randomNumber(1),
      'LuasAktif' => $this->faker->randomFloat(2, 0, 15),
      'Sat' => $this->faker->randomElement(['HA']),
      'ExsTanaman' => 'Nanas',
      '% Tanaman Hancur' => $this->faker->randomFloat(2, 70, 100),
      '% Bonggol Tercacah' => $this->faker->randomFloat(2, 70, 100),
      '% Aplikasi Rapat' => $this->faker->randomFloat(2, 40, 100),
      'Total (%)' => $this->faker->randomFloat(2, 70, 100),
    ];
  }
}
