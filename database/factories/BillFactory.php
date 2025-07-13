<?php

namespace Database\Factories;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 50, 500); // Giá dịch vụ từ 50-500
        $taxVAT = $subtotal * 0.1; // Thuế VAT 10%
        $total = $subtotal + $taxVAT;

        return [
            'id' => time() . mt_rand(100000, 999999),
            // 'payment_method' => $this->faker->randomElement(['wallet', 'credit_card', 'qr_transfer']),
            'payment_method' => $this->faker->randomElement(['qr_transfer']), //only support QR transfer for now
            'taxVAT' => $taxVAT,
            'total' => $total,
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
        ];
    }

    /**
     * Bill với trạng thái đã thanh toán
     */
    public function paid(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'paid',
        ]);
    }

    /**
     * Bill với trạng thái chờ thanh toán
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Bill với số tiền cụ thể
     */
    public function withAmount(float $amount): static
    {
        $taxVAT = $amount * 0.1;
        $total = $amount + $taxVAT;

        return $this->state(fn(array $attributes) => [
            'taxVAT' => $taxVAT,
            'total' => $total,
        ]);
    }
}
