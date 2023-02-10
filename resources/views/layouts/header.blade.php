<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="d-none d-lg-block">
                <form class="app-search ">
                    <div class="app-search-box dropdown ">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search..." id="top-search">
                            <button class="btn input-group-text" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                        <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow mb-2">Found 22 results</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-home me-1"></i>
                                <span>Analytics Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-aperture me-1"></i>
                                <span>How can I help you?</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>User profile settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex me-2 rounded-circle" src="{{URL::asset('assets/images/users/user-2.jpg')}}" alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                            <span class="font-12 mb-0">UI Designer</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex me-2 rounded-circle" src="{{URL::asset('assets/images/users/user-5.jpg')}}" alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Jacob Deo</h5>
                                            <span class="font-12 mb-0">Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </li>
            <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{URL::asset('assets/images/flags/us.jpg')}}" alt="user-image" height="16">
                </a>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="{{URL::asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="{{URL::asset('assets/images/flags/italy.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">

                        <img src="{{URL::asset('assets/images/flags/spain.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">

                        <img src="{{URL::asset('assets/images/flags/russia.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </li>
            @if (Auth::check())
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if (Auth::user()->profile_url)
                    <img src="{{ asset('storage/images/'.Auth::user()->profile_url)}}" alt="user-image" class="rounded-circle">
                  @else
                    <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                    @endif
                    @if(Auth::check())
                    <span class="pro-user-name ms-1">
                        {{ Auth::user()->username }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown " style="
                    min-width: 250px;">
                    item
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
                    <div class="d-flex text-center"  class="dropdown-item notify-item" >
                        <div class="col-6">
                                <a href="{{route('getinvoice')}}" class="">


                                    {{-- <span>Get Invoice</span> --}}

                                    <button type="submit" class="fs-6 btn btn-dark underline text-sm text-gray-600 hover:text-gray-900 ml-2">

                                        <i class="fa-solid fa-file-lines"></i>{{ __('Get Invoice') }}
                                    </button>
                                </a>
                        </div>
                        <div class="col-7">
                            <a href="{{route('track.order')}}" class="">


                                {{-- <span>Take Order</span> --}}
                                <button type="submit" class="fs-6 btn btn-primary underline  text-sm text-gray-600 hover:text-gray-900 ml-2" style="margin-right:22px">

                                    <i class="fa-solid fa-cart-shopping"></i>
                                    {{ __('Track Order') }}
                                </button>
                            </a>
                        </div>
                   </div>
                   <hr>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="{{route('lockScreen')}}" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a>


                    <div class="dropdown-divider"></div>

                    <!-- item-->

                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a> --}}
                    <div class=" dropdown-item notify-item">
                    <form method="POST" action="{{ route('logout') }}" class="inline mx-3 ">
                        @csrf

                        {{-- <p type="submit" class="text-danger underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                            {{ __('Log Out') }}
                        </p> --}}
                        <button type="submit" class="btn text-sm text-gray-600 hover:text-gray-900 ml-2 mx-n3 m-lg-n4 ">
                            <i class="fa-solid fa-right-from-bracket"></i>  {{ __('Log Out') }}
                        </button>
                    </form>
                </div>

                </div>
            </li>
            @endif
            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{route('home')}}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="https://portal.unikoop.com/images/LeyWood%20-%20Losse%20Logo's-01.jpg" class="mx-2" alt="LeyWood" width="70" height="50">

                    {{-- <img src="{{URL::asset('assets/images/logo-sm.png')}}" alt="" height="22"> --}}
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="https://portal.unikoop.com/images/LeyWood%20-%20Losse%20Logo's-01.jpg" alt="LeyWood" width="100" height="50">
                </span>
            </a>
            <a href="{{route('home')}}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="https://portal.unikoop.com/images/LeyWood%20-%20Losse%20Logo's-01.jpg"  class="mx-2"  alt="LeyWood" width="70" height="50">
                </span>
                <span class="logo-lg">
                    <img src="https://portal.unikoop.com/images/LeyWood%20-%20Losse%20Logo's-01.jpg" alt="LeyWood" width="100" height="50">
                </span>
            </a>
        </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
