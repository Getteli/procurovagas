<?php

namespace Database\Factories;

use App\Models\emails;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = emails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
