@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Create new order

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
    <form action="{{ route('order.store') }}" method="post">
        @csrf
        @method('post')
        <div class="card-body ">
            <div class="row row-cards">
                <div class="col-xl-12">



                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-label">Brand</div>
                                <select class="form-select select2 brand" name="brand_id" id="brand_id">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Brand::all() as $brand)
                                    <option {{ old('brand_id')== $brand->id?'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="mb-3">
                                <label class="form-label"> Quantity</label>
                                <input type="text" name="quantity" class="form-control"  value="{{ old('quantity') }}"  placeholder="Enter  Quantity">
                              </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-label">Product</div>
                                <select class="form-select select2 product" name="product_id" id="product_id">

                                </select>
                              </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="{{ route('order.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto">Send data</button>
            </div>
        </div>
    </form>
</div>



@endsection
