@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Create new Product

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('product.store') }}" method="post">
    @csrf
    @method('post')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">
                    <div class="row">



                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Barcode</label>
                                <input type="text" name="barcode" class="form-control"  value="{{ old('barcode') }}"  placeholder="Enter  Barcode">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Item Net Weight</label>
                                <input type="text" name="inw" class="form-control"  value="{{ old('inw') }}"  placeholder="Enter Net  Weight">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Item Gross Weight</label>
                                <input type="text" name="igw" class="form-control"  value="{{ old('igw') }}"  placeholder="Enter Gross Weight">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Width</label>
                                <input type="number" name="width" class="form-control"  value="{{ old('width') }}"  placeholder="Enter   Width">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Height</label>
                                <input type="number" name="height" class="form-control"  value="{{ old('height') }}"  placeholder="Enter   Height">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Unit</label>
                                <input type="number" name="unit" class="form-control"  value="{{ old('unit') }}"  placeholder="Enter   Unit">
                              </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Case Volume</label>
                                <input type="text" name="volume" class="form-control"  value="{{ old('volume') }}"  placeholder="Enter   Case Volume">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control"  value="{{ old('price') }}"  placeholder="Enter   Price">
                              </div>
                        </div>
         <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Country Tariff code
                                </label>
                                <input type="number" name="traffic_code" class="form-control"  value="{{ old('traffic_code') }}"  placeholder="Enter   Country Tariff code">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">SOUTH AFRICA TARIFF CODES
                                </label>
                                <input type="number" name="south_code" class="form-control"  value="{{ old('south_code') }}"  placeholder="Enter   SOUTH AFRICA TARIFF CODES">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">EURO CETIFICATION NUMBER
                                </label>
                                <input type="number" name="euro_number" class="form-control"  value="{{ old('euro_number') }}"  placeholder="Enter   EURO CETIFICATION NUMBER">
                              </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-label">Supplier</div>
                                <select class="form-select select2" name="supplier_id" id="supplier_id">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Supplier::all() as $supplier)
                                    <option {{ old('supplier_id')== $supplier->id?'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-label">Brand</div>
                                <select class="form-select select2" name="brand_id" id="brand_id">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Brand::all() as $brand)
                                    <option {{ old('brand_id')== $brand->id?'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Description <span class="form-label-description"></span></label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Description..">{{old('description') }}</textarea>
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
