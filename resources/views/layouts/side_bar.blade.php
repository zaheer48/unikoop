@section('sidebar')
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            @if (Auth::user()->profile_photo ?? '')
                <img src="{{ asset('storage/images/'.Auth::user()->profile_photo)}}" alt="user-image" class="rounded-circle">
            @else
                <img src="{{URL::asset('assets/images/users/avatar.png')}}" alt="user-image" class="rounded-circle">
            @endif
            <div class="dropdown">
                @if(Auth::check())
                    <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">
                        {{ Auth::user()->username }}
                    </a>
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
                    <a href="{{ route('dashboard') }}"
                     {{-- href="#sidebarDashboards" --}}
                      data-bs-toggle="collapse">
                        <i data-feather="airplay"></i>
                        <!-- <span class="badge bg-success rounded-pill float-end">4</span> -->
                        <span> Dashboards </span>
                    </a>
                    {{-- <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>

                        </ul>
                    </div> --}}
                </li>
                <li>
                    <a href="{{ route('my.wallet')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-wallet"></i>
                        <span>My Wallet</span>
                    </a>
                </li>
                <li>

                    <a href="{{ route('my.profile')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Profile</span>
                    </a>
                </li>                
                {{-- <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Ecommerce </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="Companies.html">Companies</a>
                            </li>
                            <li>
                                <a href="All-Lists.html">All-Lists</a>
                            </li>

                            <li>
                                <a href="All-Orders.html">All-Orders</a>
                            </li>
                            <li>
                                <a href="Orders.html">Orders</a>
                            </li>

                        </ul>
                    </div>
                </li> --}}
                {{-- <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Products </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">

                            <li>
                                <a href="ProductList">All-Lists</a>
                            </li>

                            <li>
                                <a href="AddProduct">Add Products</a>
                            </li>
                            <li>
                                <a href="UpdateProduct">Update Products</a>
                            </li>

                        </ul>
                    </div>
                </li> --}}
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <span> Transaction Report</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('account.report') }}">See All</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('invoice') }}">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Create Invoice</span>
                        {{-- <span class="menu-arrow"></span> --}}
                    </a>
                    {{-- <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('invoice') }}">Create Invoice</a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                <li>
                    <a href="{{route('download.label')}}">
                        <i class="fa-solid fa-download"></i>
                        <span> Download Label </span>
                        {{-- <span class="menu-arrow"></span> --}}
                    </a>
                    {{-- <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('download.label')}}">Download Label</a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
@endsection
