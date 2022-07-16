<?php

namespace Tests\Feature;

use App\Data\Models\FertilizerInventoryMovement;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreFertilizerInventoryMovementFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TEST FOR SUCCESS OF FEATURE
     *
     * @return void
     */
    public function test_store_fertilizer_inventory_movement_feature()
    {
        // insert into database
        FertilizerInventoryMovement::factory()->count(3)->create();
        
        $response = $this->call('POST', '/', [ 'quantity' => 1 ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
        $this->followRedirects($response)->assertSee('success');
        $this->followRedirects($response)->assertSee('quantity');
        //assertSessionHasErrors
    }
}
