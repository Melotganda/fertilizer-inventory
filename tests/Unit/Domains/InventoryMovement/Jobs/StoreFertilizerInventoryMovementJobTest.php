<?php

namespace Tests\Unit\Domains\InventoryMovement\Jobs;

use App\Data\Models\FertilizerInventoryMovement;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreFertilizerInventoryMovementJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TEST FOR SUCCESS
     *
     * @return void
     */
    public function test_store_fertilizer_inventory_movement_job()
    {
        // insert into database
        FertilizerInventoryMovement::factory()->count(3)->create();

        $data = [
            'quantity' => 1
        ];
        
        $response = $this->call('POST', '/', $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
        $this->followRedirects($response)->assertSee('success');
        $this->followRedirects($response)->assertSee('quantity');
    }

    /**
     * TEST FAILED VALIDATION
     *
     * @return void
     */
    public function test_validation_for_store_fertilizer_inventory_movement_job()
    {
        // insert into database
        FertilizerInventoryMovement::factory()->count(3)->create();

        $data = [
            'quantity' => -1
        ];
        
        $response = $this->call('POST', '/', $data);
        $response->assertStatus(302); // 302 because the post is returning view
        $response->assertSessionHasErrors('quantity');
        $response->assertRedirect(route('home'));
        // $this->followRedirects($response)->assertSessionHasErrors();
    }
    
    /**
     * TEST LOW ON STOCK
     *
     * @return void
     */
    public function test_low_on_stock_store_fertilizer_inventory_movement_job()
    {
        // insert into database
        $movements = FertilizerInventoryMovement::factory()->count(3)->create();
        $totalStocks = 0;

        foreach ($movements as $movement) {
            $totalStocks += $movement->quantity;
        }
        $data = [
            'quantity' => $totalStocks-3
        ];
        
        $response = $this->call('POST', '/', $data);
        $response->assertStatus(302); // 302 because the post is returning view
        $response->assertRedirect(route('home'));
        $this->followRedirects($response)->assertSee('success');
        $this->followRedirects($response)->assertSee('quantity');
    }

    /**
     * TEST QUANTITY IS GREATER THAN STOCK
     *
     * @return void
     */
    public function test_quantity_is_greater_than_stock_store_fertilizer_inventory_movement_job()
    {
        // insert into database
        $movements = FertilizerInventoryMovement::factory()->count(3)->create();
        $totalStocks = 0;

        foreach ($movements as $movement) {
            $totalStocks += $movement->quantity;
        }
        $data = [
            'quantity' => $totalStocks+3
        ];
        
        $response = $this->call('POST', '/', $data);
        $response->assertStatus(302); // 302 because the post is returning view
        $response->assertSessionHasErrors('message');
        $response->assertRedirect(route('home'));
    }
    
    /**
     * TEST OUT OF STOCK
     *
     * @return void
     */
    public function test_out_of_stock_store_fertilizer_inventory_movement_job()
    {
        // insert into database
        $movements = FertilizerInventoryMovement::factory()->count(3)->create();
        $totalStocks = 0;

        foreach ($movements as $movement) {
            $totalStocks += $movement->quantity;
        }
        $data = [
            'quantity' => $totalStocks
        ];
        
        $response = $this->call('POST', '/', $data);
        $response->assertStatus(302); // 302 because the post is returning view
        $this->followRedirects($response)->assertSee('success');
        $this->followRedirects($response)->assertSee('quantity');

        // call again the request
        $response = $this->call('POST', '/', ['quantity' => $totalStocks]);
        $response->assertStatus(302); // 302 because the post is returning view
        $response->assertSessionHasErrors();
        $response->assertRedirect(route('home'));
    }
}
