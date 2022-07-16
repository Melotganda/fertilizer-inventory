<?php

namespace Database\Seeders;

use App\Data\Models\FertilizerInventoryMovement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FertilizerInventoryMovementSeeder extends Seeder
{
    /**
     * Data from the csv provided in the email
     *
     * @var array
     */
    private array $fertilizerInventoryMovementHistory = [
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 10,
            'unit_price' => 5,
            'created_at' => '2020-06-05',
            'updated_at' => '2020-06-05'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 30,
            'unit_price' => 4.5,
            'created_at' => '2020-06-07',
            'updated_at' => '2020-06-07'
        ],
        [
            'type' => FertilizerInventoryMovement::APPLICATION,
            'quantity' => -20,
            'created_at' => '2020-06-08',
            'updated_at' => '2020-06-08'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 10,
            'unit_price' => 5,
            'created_at' => '2020-06-09',
            'updated_at' => '2020-06-09'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 34,
            'unit_price' => 4.5,
            'created_at' => '2020-06-10',
            'updated_at' => '2020-06-10'
        ],
        [
            'type' => FertilizerInventoryMovement::APPLICATION,
            'quantity' => -25,
            'created_at' => '2020-06-15',
            'updated_at' => '2020-06-15'
        ],
        [
            'type' => FertilizerInventoryMovement::APPLICATION,
            'quantity' => -37,
            'created_at' => '2020-06-23',
            'updated_at' => '2020-06-23'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 47,
            'unit_price' => 4.3,
            'created_at' => '2020-07-10',
            'updated_at' => '2020-07-10'
        ],
        [
            'type' => FertilizerInventoryMovement::APPLICATION,
            'quantity' => -38,
            'created_at' => '2020-07-12',
            'updated_at' => '2020-07-12'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 10,
            'unit_price' => 5,
            'created_at' => '2020-07-13',
            'updated_at' => '2020-07-13'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 50,
            'unit_price' => 4.2,
            'created_at' => '2020-07-25',
            'updated_at' => '2020-07-25'
        ],
        [
            'type' => FertilizerInventoryMovement::APPLICATION,
            'quantity' => -28,
            'created_at' => '2020-07-26',
            'updated_at' => '2020-07-26'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 10,
            'unit_price' => 5,
            'created_at' => '2020-07-31',
            'updated_at' => '2020-07-31',
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 15,
            'unit_price' => 5,
            'created_at' => '2020-08-14',
            'updated_at' => '2020-08-14'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 3,
            'unit_price' => 6,
            'created_at' => '2020-08-17',
            'updated_at' => '2020-08-17'
        ],
        [
            'type' => FertilizerInventoryMovement::PURCHASE,
            'quantity' => 2,
            'unit_price' => 7,
            'created_at' => '2020-08-29',
            'updated_at' => '2020-08-29'
        ],
        [
            'type' => FertilizerInventoryMovement::APPLICATION,
            'quantity' => -30,
            'created_at' => '2020-08-31',
            'updated_at' => '2020-08-31'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->fertilizerInventoryMovementHistory as $movements) {
            FertilizerInventoryMovement::insert($movements);
        }
    }
}
