@extends('main.manager')

@section('content')

        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        staffs
                        ({{$staffs->total()}})

                    </h2>
                </div>
            </div>
            <form class="bl" action="{{route('staff.index')}}" method="get">
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
                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
                        <a href="{{ route('staff.create') }}" class="btn btn-primary w-100 ml-1">
                            New staff
                          </a>
                      </div>
                </div>
            </form>



        </div>


        <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($company)
                    <tr class="bg-dark text-white">
                        <td>---</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->lastname }}</td>
                        <td>{{ $company->username }}</td>
                        <td>{{ $company->password }}</td>
                        <td>
                            <a href="{{ asset('/media/company/'.$company->logo) }}">Logo</a>
                          <a href="{{ route('edit.company') }}">Edit</a>
                        </td>
                      </tr>
                    @endif


                    @foreach ($staffs as $staff)

                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $staff->name }}</td>
                      <td>{{ $staff->lastname }}</td>
                      <td>{{ $staff->username }}</td>
                      <td>{{ $staff->password }}</td>
                      <td>
                        <a href="{{ route('staff.edit',$staff->id) }}">Edit</a>
                      </td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <div class="d-flex mt-4">
            {{ $staffs->appends(Request::all())->links('admin.section.pagination') }}
        </div>
    </div>

@endsection
