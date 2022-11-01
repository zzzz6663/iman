@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Update Product
                {{ $product->name }}
            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('product.update',$product->id) }}" method="post">
    @csrf
    @method('patch')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Name</label>
                                <input type="text" name="name" class="form-control"  value="{{ old('name',$product->name) }}"  placeholder="Enter  Name">
                              </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Barcode</label>
                                <input type="text" name="barcode" class="form-control"  value="{{ old('barcode',$product->barcode) }}"  placeholder="Enter  Barcode">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Item Net Weight</label>
                                <input type="text" name="inw" class="form-control"  value="{{ old('inw',$product->inw) }}"  placeholder="Enter Net  Weight">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Item Gross Weight</label>
                                <input type="text" name="igw" class="form-control"  value="{{ old('igw',$product->igw) }}"  placeholder="Enter Gross Weight">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Width</label>
                                <input type="number" name="width" class="form-control"  value="{{ old('width',$product->width) }}"  placeholder="Enter   Width">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Height</label>
                                <input type="number" name="height" class="form-control"  value="{{ old('height',$product->height) }}"  placeholder="Enter   Height">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-label">Unit</div>
                                <select class="form-select " name="unit" id="unit">
                                    <option value="">please select</option>
                                    <option {{ old('unit',$product->unit)=='ml'?'selected':'' }} value="ml">ml</option>
                                    <option {{ old('unit',$product->unit)=='kg'?'selected':'' }} value="kg">kg</option>
                                    <option {{ old('unit',$product->unit)=='ltr'?'selected':'' }} value="ltr">ltr</option>
                                </select>
                              </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Case Volume</label>
                                <input type="text" name="volume" class="form-control"  value="{{ old('volume',$product->volume) }}"  placeholder="Enter   Case Volume">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" step="0.001" class="form-control"  value="{{ old('price',$product->price) }}"  placeholder="Enter   Price">
                              </div>
                        </div>
         {{-- <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Country Tariff code
                                </label>
                                <input type="number" name="traffic_code" class="form-control"  value="{{ old('traffic_code',$product->traffic_code) }}"  placeholder="Enter   Country Tariff code">
                              </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">SOUTH AFRICA TARIFF CODES
                                </label>
                                <input type="number" name="south_code" class="form-control"  value="{{ old('south_code',$product->south_code) }}"  placeholder="Enter   SOUTH AFRICA TARIFF CODES">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">EURO CETIFICATION NUMBER
                                </label>
                                <input type="number" name="euro_number" class="form-control"  value="{{ old('euro_number',$product->euro_number) }}"  placeholder="Enter   EURO CETIFICATION NUMBER">
                              </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-label">Supplier</div>
                                <select class="form-select select2" multiple name="suppliers[]" id="supplier_id">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Supplier::all() as $supplier)
                                    <option {{in_array($supplier->id ,old('suppliers',$product->suppliers()->pluck('id')->toArray()) ) ?'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                                    <option {{ old('brand_id',$product->brand_id)== $brand->id?'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Description <span class="form-label-description"></span></label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Description..">{{old('description',$product->description) }}</textarea>
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
