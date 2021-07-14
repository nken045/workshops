<?php

namespace Database\Factories;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkshopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workshop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'host_user_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->text(),
            'venue_id' => $this->faker->numberBetween(0, 46),
            'venue' => $this->faker->city(),
            'description' => $this->faker->sentences(),
            'caution' => $this->faker->date(),
            'cancellation_deadline' => $this->faker->date(),
            'min_participants' => $this->faker->numberBetween(0, 20),
            'participation_fee' =>  $this->faker->numberBetween(0, 10000),
            'status' => $this->faker->numberBetween(0, 20)
        ];
    }
}
