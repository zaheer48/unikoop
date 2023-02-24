<div class="left-side-menu">
    <div class="h-100" data-simplebar>        
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="airplay"></i>
                        <!-- <span class="badge bg-success rounded-pill float-end">4</span> -->
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all.orders')}}">
                        <i data-feather="shopping-cart"></i>
                        <span> Orders</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ route('payment.history')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <span>Payment History</span>
                    </a>
                </li> --> 
                @if($modules['InvoiceTemplate']->isEnabled())               
                <li>
                    <a href="{{ route('invoice') }}">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Create Invoice</span>
                        {{-- <span class="menu-arrow"></span> --}}
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{route('download.label')}}">
                        <i class="fa-solid fa-download"></i>
                        <span> Download Label </span>
                        {{-- <span class="menu-arrow"></span> --}}
                    </a>
                </li>
                <li>
                    <a href="{{ route('payment.history')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <span>Payment History</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
