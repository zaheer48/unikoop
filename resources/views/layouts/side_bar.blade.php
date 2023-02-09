@section('sidebar')
<div class="left-side-menu">
    <div class="h-100" data-simplebar>        
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="airplay"></i>
                        <!-- <span class="badge bg-success rounded-pill float-end">4</span> -->
                        <span> Dashboards </span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>

                        </ul>
                    </div>
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
                <li>
                    <a href="{{ route('email-templates.index')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <span>Email Templates</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('invoice-templates.index')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Invoice Templates</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('packinglist-templates.index')}}" class="dropdown-item notify-item">
                        <i class="fa-sharp fa-solid fa-list-ul"></i>
                        <span>Packing List Templates</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('payment.history')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <span>Payment History</span>
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
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span> Invoice</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('invoice') }}">Create Invoice</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="fa-solid fa-download"></i>
                        <span> Download Label </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('download.label')}}">Download Label</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
@endsection
