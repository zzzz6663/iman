
@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Pass Product To
                {{ $user->username }}
            </h2>
            <br>
        </div>
    </div>

    <form class="bl" action="{{route('pass.products',$user->id)}}" method="get">
        @csrf
        @method('get')
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="mb-3"> 
                    <select class="form-select select2 " name="product" id="product">
                        <option value="">please select</option>
                        @foreach ( $products  as $pro )
                        <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                            <span data-branch="{{ $user->id }}" class="add_product btn btn-blue">Add Product</span>
                  </div>
            </div>
            {{-- <div class="col-6">
                <div class="d-flex ">
                    <input type="search" name="search" value="{{request('search')}}" class="form-control d-inline-block w-9 me-3" placeholder=" search  ">
                    <button class="btn btn-dark w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="10" cy="10" r="7"></circle>
                            <line x1="21" y1="21" x2="15" y2="15"></line>
                        </svg>
                        search
                    </button>


                </div>
            </div> --}}

        </div>
    </form>


</div>
<br>
<div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>name</th>
              <th>barcode</th>
              <th>price</th>
              <th>south code</th>
              <th>euro number</th>
              <th>traffic code </th>
              <th class="ط1"></th>
            </tr>
          </thead>
          <tbody id="tbody_p">
            @foreach ($user_products as $product )
                @include('admin.product.product_row')
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
<div class="d-flex mt-4">
    {{-- {{ $brands->appends(Request::all())->links('admin.section.pagination') }} --}}
</div>
{{-- <div class="card">
    @include('main.error')
   <form action="{{ route('pass.products',$user->id) }}" method="post">
    @csrf
    @method('post')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Select Product</div>
                                <select class="form-select select2" multiple="multiple" name="products[]" id="brand_id">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Product::all() as $product)
                                    <option {{ in_array($product->id,old('products',$user->branch_products()->pluck('id')->toArray())) ?'selected':'' }} value="{{ $product->id }}">{{ $product->barcode }}</option>
                                    @endforeach
                                </select>

                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Passed  Products</div>
                                @foreach ($user->branch_products as $p)
                                    {{ $p->barcode }} -
                                @endforeach
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
 --}}


@endsection
