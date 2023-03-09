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
                    <a href="{{ route('user.order.history')}}" class="dropdown-item notify-item">
                    <i data-feather="airplay"></i>
                        <span>Order History</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('get.invoice')}}" class="dropdown-item notify-item">
                    <i data-feather="airplay"></i>
                        <span>Get Invoice</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('track.order')}}" class="dropdown-item notify-item">
                    <i data-feather="airplay"></i>
                        <span>Track Order</span>
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
