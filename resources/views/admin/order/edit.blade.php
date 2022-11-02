@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Update  Order Number
                {{ $order->id }}

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')

        <div class="card-body ">
            <div class="row row-cards">
                <div class="col-xl-12">



                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-label">Brand</div>
                                <select class="form-select select2 brand" name="brand" id="brand">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Brand::all() as $brand)
                                    <option {{ old('brand_id')== $brand->id?'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" placeholder="Enter  Quantity">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-label">Product</div>
                                <select class="form-select select2 product" name="product_id" id="product">

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
                <span type="submit" class="btn add_order btn-primary ms-auto">ADD To Order </span>
            </div>
        </div>

</div>
<br>
<br>
<form action="{{ route('order.update' ,$order->id) }}" method="post">
    @csrf
    @method('patch')
<div class="col-12">
    <div class="card">
        <div class="card-body">
        <h1 class="card-title">Order </h1>

        </div>
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>brand</th>
                        <th>product</th>
                        <th>quantity</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="order_tbody">

                    @foreach ($order->products as $product)
                    <tr class="par">
                        <td class="count">{{ $loop->iteration }}</td>
                        <td>{{ $product->brand->name }}  <input type="text" name="brands[]" value="{{ $product->brand->id }}" hidden> </td>
                        <td>{{ $product->name }}  <input type="text" name="products[]" value="{{ $product->id }}}" hidden></td>
                        <td>{{ $product->pivot->quantity }}   <input type="text" name="quantities[]" value="{{ $product->pivot->quantity }} " hidden></td>
                        <td>
                        <span class="remove_order btn btn-danger">remove</span>
                        </td>
                           </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">

            <ul class="pagination m-0 ms-auto">
                <button class="btn btn-primary">Save Order</button>
            </ul>
          </div>
    </div>
</div>
</form>

@endsection
