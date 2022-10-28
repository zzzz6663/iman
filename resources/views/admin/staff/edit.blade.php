@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                update  staff
                {{ $staff->name }}
                {{ $staff->lastname }}

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('staff.update',$staff->id) }}" method="post">
    @csrf
    @method('patch')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">

                  <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input type="text" name="name" class="form-control"  value="{{ old('name',$staff->name) }}"  placeholder="Enter  Name">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control"  value="{{ old('lastname',$staff->lastname) }}"  placeholder="Enter  Last Name">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" name="username" class="form-control"  value="{{ old('username',$staff->username) }}"  placeholder="Enter User Name">
                  </div>




                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control"  value="{{ old('password',$staff->password) }}"  placeholder="Enter Password ">
                  </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
          <a href="{{ route('staff.index') }}" class="btn btn-link">Cancel</a>
          <button type="submit" class="btn btn-primary ms-auto">update data</button>
        </div>
      </div>
   </form>
</div>



@endsection
