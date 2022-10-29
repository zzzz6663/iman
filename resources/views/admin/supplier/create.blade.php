@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Create new supplier

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('supplier.store') }}" method="post">
    @csrf
    @method('post')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Name</label>
                                <input type="text" name="name" class="form-control"  value="{{ old('name') }}"  placeholder="Enter  Name">
                              </div>


                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Email</label>
                                <input type="email" name="email" class="form-control"  value="{{ old('email') }}"  placeholder="Enter  Email ">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Phone</label>
                                <input type="tell" name="phone" class="form-control"  value="{{ old('phone') }}"  placeholder="Enter  Phone ">
                              </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" id="" cols="30" class="form-control"  rows="5">{{ old('address') }}</textarea>
                              </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Info</label>
                                <textarea name="info" id="" cols="30" class="form-control"  rows="5">{{ old('info') }}</textarea>
                              </div>
                        </div>
                    </div>



            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
          <a href="{{ route('supplier.index') }}" class="btn btn-link">Cancel</a>
          <button type="submit" class="btn btn-primary ms-auto">Send data</button>
        </div>
      </div>
   </form>
</div>



@endsection
