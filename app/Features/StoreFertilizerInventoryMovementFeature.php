<?php

namespace App\Features;

use App\Domains\InventoryMovement\Jobs\StoreFertilizerInventoryMovementJob;
use App\Domains\InventoryMovement\Requests\StoreFertilizerInventoryMovementRequest;
use Illuminate\Validation\ValidationException;
use Lucid\Units\Feature;

class StoreFertilizerInventoryMovementFeature extends Feature
{
    public function handle(StoreFertilizerInventoryMovementRequest $request)
    {
        try {
            // run the job
            $inventoryMovement = $this->run(StoreFertilizerInventoryMovementJob::class, [
                'quantity' => $request->input('quantity')
            ]);

            return redirect(route('home'))->with($inventoryMovement);
        } catch (ValidationException $error) {
            return redirect(route('home'))->with($error);
        } catch (\Exception $error) {
            return redirect(route('home'))->withErrors(['message' => $error->getMessage()]);
        }
    }
}
