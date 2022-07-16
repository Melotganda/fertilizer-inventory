<?php

namespace App\Http\Controllers;

use App\Features\StoreFertilizerInventoryMovementFeature;
use Illuminate\Http\Request;
use Lucid\Units\Controller;

class FertilizerInventoryMovementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return $this->serve(StoreFertilizerInventoryMovementFeature::class);
    }
}
