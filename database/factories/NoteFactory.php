<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3,true),
            'body' => $this->faker->text(200),
            'public' =>  $this->faker->boolean(50),
            'category_id' =>  $this->faker->numberBetween(1,5),
            'project_id' =>  $this->faker->numberBetween(1,5),
            'author_id' =>  $this->faker->numberBetween(1,2),
        ];
    }
}
