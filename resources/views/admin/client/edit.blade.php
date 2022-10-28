@extends('main.manager')

@section('content')

<!-- Page title -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Edit  client
                {{ $client->company }}
            </h2>
        </div>
    </div>


</div>

<div class="card">
    @include('main.error')
   <form action="{{ route('client.update',$client->id) }}" method="post">
    @csrf
    @method('patch')
    <div class="card-body ">
        <div class="row row-cards">
            <div class="col-xl-12">

                  <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" name="username" class="form-control"  value="{{ old('username',$client->username) }}"  placeholder="Enter User Name">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Company name  </label>
                    <input type="text" name="company" class="form-control"  value="{{ old('company',$client->company) }}"  placeholder="Company name">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contact person</label>
                    <input type="text" name="person" class="form-control"  value="{{ old('person',$client->person) }}"  placeholder="Enter Contact person">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tell" name="phone" class="form-control"  value="{{ old('phone',$client->phone) }}"  placeholder="Enter User Phone">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tax number</label>
                    <input type="tell" name="tax" class="form-control"  value="{{ old('tax',$client->tax) }}"  placeholder="Enter Tax number">
                  </div>
                  <div class="mb-3">
                    <div class="form-label">Country</div>
                    <select class="form-select select2" name="country_id" id="country">
                        <option value="">please select</option>
                        @foreach (App\Models\Country::all() as $country)
                        <option {{ old('country_id',$client->id)== $country->id?:'selected' }} value="{{ $country->id }}">{{ $country->en_name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Address <span class="form-label-description"></span></label>
                    <textarea class="form-control" name="address" rows="6" placeholder="Address..">{{old('address',$client->address) }}</textarea>
                  </div>


                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control"  value="{{ old('password',$client->password) }}"  placeholder="Enter Password ">
                  </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
          <a href="{{ route('client.index') }}" class="btn btn-link">Cancel</a>
          <button type="submit" class="btn btn-primary ms-auto">Update data</button>
        </div>
      </div>
   </form>
</div>



@endsection
