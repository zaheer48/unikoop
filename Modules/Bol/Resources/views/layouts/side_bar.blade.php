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
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Orders</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('all.orders')}}">All Orders</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('payment.history')}}" class="dropdown-item notify-item">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <span>Payment History</span>
                    </a>
                </li>
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
