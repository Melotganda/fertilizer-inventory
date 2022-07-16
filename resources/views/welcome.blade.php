@extends('layouts.app')
@section('content')
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="my-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fertilizer Inventory</h5>
                            <form method="post" action="{{ route('store-fertilizer-movement') }}">
                                @csrf
                                <div class="form-floating">
                                    <label class="form-label" for="quantity">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="No. of unit/s needed" style="height: 5rem" required>
                                    
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br />
                                <div class="col-md-auto col-12 float-right">
                                    <button class="btn btn-outline-primary btn-sm fw-bold text-uppercase"  type="submit">Request</button>
                                </div>
                            </form>
                            
                            @if ($message = session('success'))
                                <div class="alert alert-success mt-5" role="alert">
                                    <h4 class="alert-heading">Success</h4>
                                    <p>{{ $message }}</p>
                                    <hr>
                                    <p class="mb-0">
                                        <strong>{{ session('quantity') }}</strong> unit/s valued at <strong>{{ session('valuation') }}</strong>
                                    </p>
                                    <hr>
                                    <p class="mb-0">
                                        @if(session('remaining_stocks') <= 20 && session('remaining_stocks') > 0)
                                            Our Stocks are running low. We only have <strong>{{ session('remaining_stocks') }}</strong> left.
                                        @else
                                            Stocks Remaining: <strong>{{ session('remaining_stocks') }}</strong>
                                        @endif
                                    </p>
                                </div>
                            @endif
                            
                            @if ($errors->any())
                                <div class="alert alert-danger mt-5" role="alert">
                                    <h5 class="alert-heading">Error</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
