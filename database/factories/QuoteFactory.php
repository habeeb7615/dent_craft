<?php

namespace Database\Factories;

use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->date('Y-m-d');
        return [
            'added_by' => 1,
            'quote_id' => Carbon::parse($date)->format('dmY').'_',
            'quote_status' => 'draft',
            'created_at' => $date,
            'updated_at' => $date
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Quote $quote) {
            $quote->customer_detail()->create([
                'user_id' => 1,
                'customer_name' => $this->faker->name,
                'contact_number' => $this->faker->phoneNumber,
                'address' => $this->faker->address,
                'email' => $this->faker->email,
                'technician' => $this->faker->name,
                'estimator' => $this->faker->name,
                'send_email_to_customer' => 0
            ]);
        });
    }
}
