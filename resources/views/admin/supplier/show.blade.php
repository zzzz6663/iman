@component('admin.section.content',['title'=>' داشبورد'])
@slot('bread')
<li class="breadcrumb-item">پنل مدیریت</li>
@endslot
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Tabler License
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="card-header">

                <div class="row row-0">
                    <div class="col-auto">
                        @if($user->avatar())
                        <img src="{{$user->avatar()}}" class="rounded-start" alt="Shape of You" width="80" height="80">
                        @else

                        @endif
                    </div>
                    <div class="col">
                        <div class="card-body">
                            {{$user->name}}
                            {{$user->family}}
                            <div class="text-muted">
                                {{$user->ostan?$user->ostan->name:'تکمیل نشده'}}
                                {{$user->shahr?$user->shahr->name:'تکمیل نشده'}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="card card-lg">
                    <div class="card-body row-card">
                        <div class="col-12">
                            <div class="carsd">
                                <div class="carsd-body">
                                    <div class="card-title">Basic info</div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        </svg>
                                        همراه : <strong> {{$user->mobile}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                            <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                            <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                            <rect x="5" y="11" width="1" height="2"></rect>
                                            <line x1="10" y1="11" x2="10" y2="13"></line>
                                            <rect x="14" y="11" width="1" height="2"></rect>
                                            <line x1="19" y1="11" x2="19" y2="13"></line>
                                        </svg>
                                        کد ملی : <strong> {{$user->code}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                                        </svg>
                                        مدرک تحصیلی: <strong>{{__('arr.'.$user->madrak)}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                                            <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="12" y1="12" x2="12" y2="12.01"></line>
                                            <path d="M3 13a20 20 0 0 0 18 0"></path>
                                        </svg>
                                        شغل: <strong>{{__('arr.'.$user->job)}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                                            <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1"></path>
                                        </svg>
                                        شماره واتس اپ : <strong> {{$user->wmobile}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                        تعداد زیر مجموعه : <strong> {{$user->sub()}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                                            <circle cx="12" cy="12" r="3"></circle>
                                            <line x1="16.5" y1="7.5" x2="16.5" y2="7.501"></line>
                                        </svg>
                                        اینستاگرام : <strong> {{$user->insta}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-telegram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"></path>
                                        </svg>
                                        تلگرام : <strong> {{$user->telegram}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5"></path>
                                            <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5"></path>
                                        </svg>
                                        رابط : <strong> {{__('arr.'.$user->connector)}}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 11h6m-3 -3v6"></path>
                                        </svg>
                                        معرف : <strong>
                                            @php($int=$user->introduced())
                                            @if($int)
                                            <a href="{{route('admin.agents.show',$int->id)}}">{{$int->name}} {{$int->family}} ({{$user->introduced}})</a>
                                            @endif
                                        </strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 11h6m-3 -3v6"></path>
                                        </svg>
                                        رمز : <strong>
                                                {{$user->password}}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card card-lg">
                            <div class="card-bodys row-card" style="padding: 10px">
                                <div class="col-12">
                                    <div class="carsd">
                                        <div class="carsd-body">
                                            <div class="card-title">توامندی ها </div>
                                            <div class="mb-2">
                                                {{$user->ability}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card card-lg">
                            <div class="card-bodys row-card" style="padding: 10px">
                                <div class="col-12">
                                    <div class="carsd">
                                        <div class="carsd-body">
                                            <div class="card-title"> ارتباطات </div>
                                            <div class="mb-2">
                                                {{$user->rel}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card card-lg">
                            <div class="card-bodys row-card" style="padding: 10px">
                                <div class="col-12">
                                    <div class="carsd">
                                        <div class="carsd-body">
                                            <div class="card-title"> درباره </div>
                                            <div class="mb-2">
                                                {{$user->about}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card card-lg">
                            <div class="card-bodys row-card" style="padding: 10px">
                                <div class="col-12">
                                    <div class="carsd">
                                        <div class="carsd-body">
                                            <div class="card-title"> همکاری </div>
                                            <div class="mb-2">
                                                {{$user->tendency}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="col">
                            <h2 class="page-title">
                            -------
                            </h2>
                        </div>
                        <div class="card">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col">
                <h2 class="page-title">
                طرح ها
                </h2>
            </div>
            <div class="card">

                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ردیف </th>
                                <th>نام </th>
                                <th>استان </th>
                                <th>شهرستان </th>
                                <th>تعداد عضو</th>
                                <th>تاریخ</th>
                                <th>اقدام</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->plans as $plan )
                            <tr>
                                <td> {{$loop->iteration}}</td>
                                <td> {{$plan->name}}</td>
                                <td> {{$plan->ostan?$plan->ostan->name:''}}</td>
                                <td> {{$plan->shahr?$plan->shahr->name:''}}</td>
                                <td> {{$plan->users()->count()}}</td>
                                <td> {{\Morilog\Jalali\Jalalian::forge($plan->created_at)}}</td>
                                </td>
                                <td>
                                    <a class="btn btn-secondary  " href="{{route('plan.edit',$plan->id)}}">ویرایش</a>
                                    <a href="{{$plan->image()}}" class="btn btn-primary  " data-lightbox="roadtrip">عکس</a>
                                </td>


                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>




<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col">
                <h2 class="page-title">
              پیام ها
                </h2>
            </div>
            <div class="card">

                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ردیف </th>
                                <th>تایتل </th>
                                <th>متن </th>
                                <th>تاریخ</th>
                                <th>مشاهده</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->payams as $payam )
                            <tr>
                                <td>  {{$loop->iteration}}</td>
                                <td>
                                                <a href="{{route('payam.edit',$payam->id)}}">{{$payam->title}}</a>

                                </td>
                                <td>  {{$payam->text}}</td>
                                <td>  {{\Morilog\Jalali\Jalalian::forge($payam->created_at)}}</td>
                                <td>
                                    @if($payam->pivot->seen)
                                    {{\Morilog\Jalali\Jalalian::forge($payam->pivot->seen)}}

                                    @else
                                    <span class="badge bg-danger">مشاهده نشده</span>
                                    @endif
                                    {{-- <a class="btn btn-secondary  " href="{{route('payam.edit',$payam->id)}}">ویرایش</a>
                                    <form style="display: inline-block" action="{{route('payam.destroy',$payam->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger " value="حذف"   >
                                    </form> --}}
                                </td>


                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col">
                <h2 class="page-title">
                زیر مجموعه ها
                </h2>
            </div>
            <div class="card">

                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ردیف </th>
                                <th>نام </th>
                                <th>رمز </th>
                                <th>موبایل </th>
                                <th>استان </th>
                                <th>شهر </th>
                                <th>تاریخ</th>
                                <th>مشاهده</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->subs() as $usersub )
                            <tr>
                                <td>  {{$loop->iteration}}</td>
                                <td>
                                                <a href="{{route('admin.agents.show',$usersub->id)}}">
                                                    {{$usersub->name}}
                                                    {{$usersub->family}}

                                                </a>

                                </td>
                                <td>  {{$usersub->password}}</td>
                                <td>  {{$usersub->mobile}}</td>

                                <td>  {{$usersub->ostan->name}}</td>
                                <td>  {{$usersub->shahr->name}}</td>
                                <td>  {{\Morilog\Jalali\Jalalian::forge($usersub->created_at)}}</td>



                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endcomponent
