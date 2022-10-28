@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Update  company
                {{ $company->company }}

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('edit.company') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">

                  <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input type="text" name="name" class="form-control"  value="{{ old('name',$company->name) }}"  placeholder="Enter  Name">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Contact person</label>
                    <input type="text" name="person" class="form-control"  value="{{ old('person',$company->person) }}"  placeholder="Enter Contact person">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tell" name="phone" class="form-control"  value="{{ old('phone',$company->phone) }}"  placeholder="Enter User Phone">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tax number</label>
                    <input type="tell" name="tax" class="form-control"  value="{{ old('tax',$company->tax) }}"  placeholder="Enter Tax number">
                  </div>


                  <div class="mb-3">
                    <label class="form-label">Email <span class="form-label-description"></span></label>
                    <input type="email" name="email" class="form-control"  value="{{ old('email',$company->email) }}"  placeholder="Enter Email">
                  </div>
                  <div class="mb-3">
                    <div class="form-label">Company logo jpg:
                    </div>
                    <input type="file" accept="image/*" name="logo" class="form-control" >
                  </div>

            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
          <a href="{{ route('staff.index') }}" class="btn btn-link">Cancel</a>
          <button type="submit" class="btn btn-primary ms-auto">Update Company</button>
        </div>
      </div>
   </form>
</div>



@endsection
