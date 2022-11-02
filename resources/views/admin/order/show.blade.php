@extends('main.manager')

@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Order Detail Number
                {{$order->id}}

            </h2>
        </div>
    </div>
    {{-- <form class="bl" action="{{route('product.index')}}" method="get">
        @csrf
        @method('get')
        <div class="row align-items-center">

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
        <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
            <a href="{{ route('product.create') }}" class="btn btn-primary w-100 ml-1">
                New product
            </a>
        </div>
</div>
</form> --}}
</div>


<div class="col-12">
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>barcode</th>
                        <th>Quantity</th>
                        <th>description</th>
                        <th>width</th>
                        <th>height</th>
                        <th>unit</th>
                        <th>inw</th>
                        <th>volume</th>
                        <th>price</th>
                        <th>south code</th>
                        <th>euro number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->pivot->name }}</td>
                        <td>{{ $product->pivot->barcode }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->description }}</td>
                        <td>{{ $product->pivot->width }}</td>
                        <td>{{ $product->pivot->height }}</td>
                        <td>{{ $product->pivot->unit }}</td>
                        <td>{{ $product->pivot->inw }}</td>
                        <td>{{ $product->pivot->volume }}</td>
                        <td>{{ $product->pivot->price }}</td>
                        <td>{{ $product->pivot->south_code }}</td>
                        <td>{{ $product->pivot->euro_number }}</td>

                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
