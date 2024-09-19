<?php

namespace Database\Factories;

use App\Models\CustomerDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quote_id' => $this->faker->range(1, 200),
            'user_id' => 1,
            'customer_name' => $this->faker->name,
            'contact_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'technician' => $this->faker->name,
            'estimator' => $this->faker->name
        ];
    }
}
