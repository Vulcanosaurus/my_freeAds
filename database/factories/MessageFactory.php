<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        do {
            $from = rand(1, 2);
            $to = rand(1, 2);
            $is_read = 1;
        } while ($from === $to);

        return [
            'from' => $from,
            'to' => $to,
            'message' => $this->faker->sentence(),
            'is_read' => $is_read
        ];
    }
}
