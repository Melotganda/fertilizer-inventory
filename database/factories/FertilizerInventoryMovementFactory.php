<?php

namespace Database\Factories;

use App\Data\Models\FertilizerInventoryMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FertilizerInventoryMovementFactory extends Factory
{
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FertilizerInventoryMovement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => rand(1,20),
            'unit_price' => rand(10,100)
        ];
    }
}
