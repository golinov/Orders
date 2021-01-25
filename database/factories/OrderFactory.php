<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->email,
            'shipping_address_1' => $this->faker->unique()->streetAddress,
            'shipping_address_2' => $this->faker->unique()->streetAddress,
            'shipping_address_3' => $this->faker->unique()->streetAddress,
            'city' => $this->faker->unique()->city,
            'country_code' => $this->faker->unique()->countryCode,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'zip_postal_code' => $this->faker->unique()->postcode,
        ];
    }
}
