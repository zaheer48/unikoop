@section('sidebar')
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                @if(Auth::check() )
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">{{ Auth::user()->username }}</a>
                    @endif
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="{{route('my.profile')}}" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Profile</span>
                    </a>

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a> --}}

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <div class=" dropdown-item notify-item">
                        <form method="POST" action="{{ route('logout') }}" class="inline mx-3 ">
                            @csrf

                            {{-- <p type="submit" class="text-danger underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                                {{ __('Log Out') }}
                            </p> --}}

                            <button type="submit" class="btn btn-btn-logout text-sm text-gray-600 hover:text-gray-900 ml-2 mx-n3 m-lg-n4">
                                <i class="fa-solid fa-right-from-bracket"></i>  {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="airplay"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('label.pricing')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-wallet"></i>
                        <span>Label Pricing</span>
                    </a>
                </li>



                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> User Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('users.index')}}">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('subadmins.index')}}">Sub Admins</a>
                            </li>
                            <li>
                                <a href="{{ route('user_requests.index')}}">User Requests</a>
                            </li>


                        </ul>
                    </div>
                </li>


                @if($modules['EmailTemplate']->isEnabled())
                <li>
                    <a href="{{ route('email-templates.index')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <span>Email Templates</span>
                    </a>
                </li>
                @endif
                @if($modules['GenerateInvoice']->isEnabled())
                <li>
                    <a href="{{ route('invoice-templates.index')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Invoice Templates</span>
                    </a>
                </li>
                @endif
                @if($modules['PackingListTemplate']->isEnabled())
                <li>
                    <a href="{{ route('packinglist-templates.index')}}" class="dropdown-item notify-item">
                        <i class="fa-sharp fa-solid fa-list-ul"></i>
                        <span>Packing List Templates</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span>Adds Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('addons') }}">AddOns</a>
                            </li>
                            <li>
                                <a href="{{ route('activate.settings') }}">Activation</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('payment.methods') }}" class="dropdown-item notify-item">
                        <i class="fa-sharp fa-solid fa-list-ul"></i>
                        <span>Payment Method</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('website.settings') }}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <span>Site Settings</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
@endsection
