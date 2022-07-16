<?php

namespace App\Domains\InventoryMovement\Jobs;

use App\Data\Models\FertilizerInventoryMovement;
use Lucid\Units\Job;

class StoreFertilizerInventoryMovementJob extends Job
{
    private $fertilizerInventoryMovement;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private $quantity){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FertilizerInventoryMovement $fertilizerInventoryMovement)
    {
        $this->fertilizerInventoryMovement = $fertilizerInventoryMovement;

        if (!$this->hasStock()) abort(400, 'We are out of stock!');
        if ($this->quantity > $this->totalStocks()) abort(400, 'Our Stocks are running low. We only have '.$this->totalStocks().' left.');

        // insert the latest movement in the database
        $latestMovement = $this->fertilizerInventoryMovement->create([
            'type' => $this->fertilizerInventoryMovement::APPLICATION,
            'quantity' => -1 * abs($this->quantity) //change the quantity into negative
        ]);

        // process the valuation
        $valuation = $this->computeValuation($latestMovement->id);

        return [
            'success' => 'Requested Stocks Successfully Applied.',
            'quantity' => $this->quantity,
            'valuation' => $valuation,
            'remaining_stocks' => $this->totalStocks()
        ];
    }

    /**
     * Get total stocks available
     *
     * @return integer
     */
    private function totalStocks() {
        return $this->fertilizerInventoryMovement->sum('quantity');
    }

    /**
     * Check if there's still a stock
     *
     * @return boolean
     */
    private function hasStock() {
        return $this->totalStocks() > 0;
    }

    /**
     * Get the oldest to latest stock movement
     *
     * @return mixed
     */
    private function getInventoryMovements() {
        return $this->fertilizerInventoryMovement->oldest()->get();
    }

    /**
     * Get the result of Valuation Computation
     *
     * @param integer $latestMovementId
     * @return mixed
     */
    private function computeValuation($latestMovementId) {
        $remainingStocks = 0;
        $appliedStocks = [];
        $remainingStocks = [];

        foreach ($this->getInventoryMovements() as $fertilizerMovement) {
            // check type of movement
            if ($fertilizerMovement->type == $this->fertilizerInventoryMovement::PURCHASE) {
                // store stock purchases in remaining stocks
                $remainingStocks[$fertilizerMovement->id] = $fertilizerMovement;
            } else {
                /**
                 * Here, we process the stock decrementation
                 */
                $movementQuantity = abs($fertilizerMovement->quantity); // make the quantity into positive for the decrementation process
                $valuation = 0;

                // loop through the oldest record
                while ( $movementQuantity > 0 ) {
                    // go back to the first record everytime the loop started
                    $previousStock = reset($remainingStocks);

                    // if remaining stock is not enough in requested quantity
                    if ($movementQuantity > $previousStock->quantity) {
                        // decrement stock quantity
                        $movementQuantity -= $previousStock->quantity;

                        // COMPUTE THE VALUATION:
                        $totalPrice = $previousStock->quantity * $previousStock->unit_price;
                        $valuation = $valuation + $totalPrice;

                        // remove the previous stock from the remaining stocks
                        unset($remainingStocks[$previousStock->id]);
                    } else {
                        // decrement stock quantity
                        $remainingStocks[$previousStock->id]['quantity'] -= $movementQuantity;

                        // COMPUTE THE VALUATION:
                        $totalPrice = $movementQuantity * $previousStock->unit_price;
                        $valuation = $valuation + $totalPrice;

                        // reset the movement quantity to zero
                        $movementQuantity = 0;
                    }
                }

                $appliedStocks[$fertilizerMovement->id] = $valuation;
            }
        }
        $valuation = $appliedStocks[$latestMovementId] ?? end($appliedStocks);

        $valuation = number_format((float)$valuation, 2, '.', ''); // convert into 2 decimal places

        return "$$valuation";
    }
}
