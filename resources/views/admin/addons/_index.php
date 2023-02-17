@extends('layouts.app')
@section('title','Addons')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
        <style>
        .badge {
            padding: 7px 10px !important;
        }
        .badge-success {
            color: #FFF !important;
            background-color: #28a745 !important;
        }
        .badge-danger {
            color: #FFF !important;
            background-color: #dc3545 !important;
        }
        input[type=text] {
            padding: 6px;
            margin-top: 8px;
            margin-right: 16px;
            font-size: 17px;
        }

        @media screen and (max-width: 600px) {
            .topnav input[type=text] {
                border: 1px solid #ccc;
            }
        }

        .todo-inbox .todo-item .todo-item-inner .action-dropdown {
            float: right;
            padding: 20px 10px 20px 10px;
        }

        .dropdown, .dropleft, .dropright, .dropup {
            position: relative;
        }

        .dropdown-toggle {
            white-space: nowrap;
        }

        .dropdown:not(.custom-dropdown-icon) .dropdown-menu {
            border: none;
            border: 1px solid #e0e6ed;
            z-index: 899;
            box-shadow: rgba(113, 106, 202, 0.2) 0px 0px 15px 1px;
            padding: 10px;
            border-width: initial;
            border-style: none;
            border-color: initial;
            border-image: initial;
        }

        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
    <div class="content-page">
        <div class="content">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-body">
                        <h3>
                            Addons List
                        </h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="userTable">
                                <thead class="theadmin-light">
                                    <tr>
                                        <th scope="col">Addon</th>
                                        <th scope="col">Actions</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($modules) > 0)
                                    @foreach($modules as $module)
                                        @php // dd($module->isDisabled()); @endphp
                                        <tr>
                                            <td>{{ $module->getName() }}</td>
                                            <td>
                                                @if($module->isEnabled())
                                                <a href="{{ route('addon.change.status', ['name' => $module->getName(), 'status' => 0]) }}" class="dropdown-item notify-item">
                                                    <i class="fa-solid fa-money-check-dollar"></i>
                                                    <span>Off</span>
                                                </a>
                                                @else
                                                <a href="{{ route('addon.change.status', ['name' => $module->getName(), 'status' => 1]) }}" class="dropdown-item notify-item">
                                                    <i class="fa-solid fa-money-check-dollar"></i>
                                                    <span>On</span>
                                                </a>
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td>No record found.</td>
                                @endif
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable();
        });
    </script>

@endsection

