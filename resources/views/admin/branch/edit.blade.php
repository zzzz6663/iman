@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Update  branch
                {{ $branch->company }}

            </h2>
        </div>
    </div>


</div>
<div class="card">
    @include('main.error')
   <form action="{{ route('branch.update',$branch->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input type="text" name="username" class="form-control"  value="{{ old('username',$branch->username) }}"  placeholder="Enter User Name">
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Company name  </label>
                                <input type="text" name="company" class="form-control"  value="{{ old('company',$branch->company) }}"  placeholder="Company name">
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Contact person</label>
                                <input type="text" name="person" class="form-control"  value="{{ old('person',$branch->person) }}"  placeholder="Enter Contact person">
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tell" name="phone" class="form-control"  value="{{ old('phone',$branch->phone) }}"  placeholder="Enter User Phone">
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"  value="{{ old('email',$branch->email) }}"  placeholder="Enter Email">
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" class="form-control"  value="{{ old('password',$branch->password) }}"  placeholder="Enter Password ">
                              </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tax number</label>
                                <input type="tell" name="tax" class="form-control"  value="{{ old('tax',$branch->tax) }}"  placeholder="Enter Tax number">
                              </div>
                              <div class="mb-3">
                                <div class="form-label">Country</div>
                                <select class="form-select select2" name="country_id" id="country">
                                    <option value="">please select</option>
                                    @foreach (App\Models\Country::all() as $country)
                                    <option {{ old('country_id',$branch->country_id)== $country->id? 'selected' :'' }} value="{{ $country->id }}">{{ $country->en_name }}</option>
                                    @endforeach
                                </select>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Address <span class="form-label-description"></span></label>
                                <textarea class="form-control" name="address" rows="6" placeholder="Address..">{{old('address',$branch->address) }}</textarea>
                              </div>
                              <div class="mb-3">
                                <div class="form-label">Company logo jpg:
                                </div>
                                <input type="file" accept="image/*" name="logo" class="form-control" >
                              </div>


                        </div>
                    </div>

            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
          <a href="{{ route('branch.index') }}" class="btn btn-link">Cancel</a>
          <button type="submit" class="btn btn-primary ms-auto">update data</button>
        </div>
      </div>
   </form>
</div>



@endsection
