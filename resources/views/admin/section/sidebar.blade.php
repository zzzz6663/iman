<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <img src="{{ auth()->user()->logo_img() }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            <br>
        </h1>
        <h1 class="navbar-brand navbar-brand-autodark">

            <a href="#">
                UserName:
                {{ auth()->user()->username }}
                <br>
                <br>
                Role:
                {{ auth()->user()->role }}
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav  pt-lg-3">
                @role('admin|branch')
                <li class="nav-item {{(Route::currentRouteName()=='client.index')?'active':''}}">
                    <a class="nav-link  {{(Route::currentRouteName()=='client.index')?'active':''}} " href="{{route('client.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <h1>
                            <span class="nav-link-title">
                                Clients
                            </span>
                        </h1>
                    </a>
                </li>
                @endrole
                @role('admin')
                <li class="nav-item {{(Route::currentRouteName()=='staff.index')?'active':''}}">
                    <a class="nav-link {{(Route::currentRouteName()=='staff.index')?'active':''}}  " href="{{route('staff.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <h1>
                            <span class="nav-link-title">
                               Staffs
                            </span>
                        </h1>
                    </a>
                </li>
                <li class="nav-item {{(Route::currentRouteName()=='branch.index')?'active':''}}">
                    <a class="nav-link {{(Route::currentRouteName()=='branch.index')?'active':''}}  " href="{{route('branch.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <h1>
                            <span class="nav-link-title">
                               Branches
                            </span>
                        </h1>
                    </a>
                </li>
                @endrole

                @role('admin|client')
                <li class="nav-item {{(Route::currentRouteName()=='order.index')?'active':''}}">
                    <a class="nav-link {{(Route::currentRouteName()=='order.index')?'active':''}}  " href="{{route('order.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <h1>
                            <span class="nav-link-title">
                                Orderes
                            </span>
                        </h1>
                    </a>
                </li>
                @endrole


                @role('admin')
                <li class="nav-item {{(Route::currentRouteName()=='brand.index')?'active':''}}">
                    <a class="nav-link {{(Route::currentRouteName()=='brand.index')?'active':''}}  " href="{{route('brand.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <h1>
                            <span class="nav-link-title">
                                Brands
                            </span>
                        </h1>
                    </a>
                </li>
                @endrole

            </ul>
        </div>
    </div>
</aside>
