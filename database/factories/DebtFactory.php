<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\DebtStatus;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debt>
 */
class DebtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('pt_BR');
        $installment = $this->faker->randomElement([true, false]);
        return [
            'description' => $this->faker->sentence,
            'category_id' => Category::all()->pluck('id')->random(),
            'date' => $this->faker->date(),
            'due_date' => $this->faker->dateTimeBetween('now', '+100 year'),
            'value' => $this->faker->randomFloat(2, 10, 1000),
            'status_id' => DebtStatus::all()->pluck('id')->random(),
            'payment_method_id' => PaymentMethod::all()->pluck('id')->random(),
            'installment' => $installment,
            'installment_number' => $installment ? $this->faker->numberBetween(1, 96) : null,
        ];
    }
}
