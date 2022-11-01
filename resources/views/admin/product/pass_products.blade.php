
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
        </div>
    </div>

    <form class="bl" action="{{route('pass.products',$user->id)}}" method="get">
        @csrf
        @method('get')
        <div class="row align-items-center">
            {{-- <div class="col-md-6">
                <div class="form-label">شهرستان</div>
                <select value="{{old('shahr_id')}}" class="form-select" name="shahr_id">
                </select>
            </div> --}}
            <div class="col-6">
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
            </div>

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
              <th>barcode</th>
              <th>price</th>
              <th>south code</th>
              <th>euro number</th>
              <th>traffic code </th>
              <th class="ط1"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product )
               <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product ->barcode }}</td>
                <td>{{ $product ->price }}</td>
                <td>{{ $product ->south_code }}</td>
                <td>{{ $product ->euro_number }}</td>
                <td>
                    {{ $user->product_traffic_code($product) }}
                  </td>
                <td class="">
                  <div class="form-selectgroup">
                    <label class="form-check par">
                        @php
                             $checked=false;
                             $status= 'Ready To Added';
                            $is_exist=  $user->branch_products()->where('product_id', $product->id)->first();
                            if($is_exist && $is_exist->pivot->show){
                              $checked=true;
                              $status= 'Added';
                            }
                        @endphp

                        <input  data-u="{{ $user->id }}"  data-p="{{ $product->id }}" {{ $checked?'checked':'' }} class="form-check-input checkzoom m check_code " type="checkbox">
                        <span  class="form-check-label ml-3 word">
                            {{ $status }}
                        </span>
                      </label>
                    {{-- <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="CSS" class="form-selectgroup-input">
                      <span class="form-selectgroup-label check_code">Add</span>
                    </label> --}}
                  </div>
                </td>
              </tr>
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
