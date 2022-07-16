<?php

namespace App\Data\Models;

use Database\Factories\FertilizerInventoryMovementFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FertilizerInventoryMovement extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return FertilizerInventoryMovementFactory::new();
    }
    
    /**
     * Constants to be used in declaring application and purchase.
     *
     */
    const APPLICATION = 'Application';
    const PURCHASE = 'Purchase';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fertilizer_inventory_movement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'quantity',
        'unit_price',
        'created_at'
    ];
}
