<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PopulationData;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PopulationData>
 */
class PopulationDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PopulationData::class;
    public function definition(): array
    {
        return [
            'nik' => $this->faker->randomDigit(20, true),
            'name' => $this->faker->word,
            'phone_number' => $this->faker->randomDigit(13, true),
            'district' => 'Pancur',
            'sub_district' => 'Budiharja',
            'address' => $this->faker->text(100),
            'information' => $this->faker->text(100),
            'person_responsible' => $this->faker->word
        ];
    }
}
