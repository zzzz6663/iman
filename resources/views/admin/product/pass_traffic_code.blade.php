@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Pass TrafficCode TO {{ $product->name }}
            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('pass.traffic.code',$product->id) }}" method="post">
    @csrf
    @method('post')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Select Product</div>
                                   <select class="form-select select2" name="product" id="brand_id">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Product::all() as $product)
                                    <option {{ old('product')==$product->id ?'selected':'' }} value="{{ $product->id }}">
                                        {{ $product->barcode }}
                                    </option>
                                    @endforeach
                                </select>
                              </div>
                        </div> --}}


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Traffic Code
                                </label>
                                <input type="number" name="traffic_code" class="form-control"  value="{{ old('traffic_code') }}"  placeholder="Enter  Traffic Code">
                              </div>
                        </div>

                    </div>



            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
          <a href="{{ route('product.index') }}" class="btn btn-link">Cancel</a>
          <button type="submit" class="btn btn-primary ms-auto">Send data</button>
        </div>
      </div>
   </form>
</div>



@endsection
