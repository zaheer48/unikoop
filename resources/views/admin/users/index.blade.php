@extends('layouts.app')
@section('title','Users')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
    @php
        $privileges = explode(",",\Auth::user()->privilages);
    @endphp
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
        .table {
            width:115%;
        }
    </style>
    <div class="content-page">
        <div class="content">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-body">
                        <h3>
                            Users List
                            @if (in_array('createuser',$privileges) || Auth::user()->is_admin == 1)
                                <a href="{{url('create')}}" class="btn btn-primary" style="float: right;">
                                    Add User
                                </a>
                            @endif
                        </h3>
                        <hr>
                        <div class="table-responsive">

                            @if (session()->has('success'))
                                <div class="alert alert-dismissable alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>
                                        {!! session()->get('success') !!}
                                    </strong>
                                </div>
                            @endif

                            <table class="table align-items-center table-flush" id="userTable">
                                <thead class="theadmin-light">
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Acount</th>
                                    <th scope="col">Credit limit</th>
                                   <th scope="col" class="col-2">Price Per Label (DHL)</th>
                                    <th scope="col"  class="col-2">Price Per Label (DPD)</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $sno = 1; ?>
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->password_hint }}</td>
                                            <td>
                                                @if($user->is_active == 0)
                                                    <span class="badge badge-pill badge-danger">De-active</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @endif
                                            </td>
                                            <td>&euro; {{ ($user->credit_limit) ? number_format($user->credit_limit,2) : 0.00 }}</td>
                                            <td>&euro; {{ ($user->price_per_label) ? number_format($user->price_per_label,2) : 0.00 }}</td>
                                            <td>&euro; {{ ($user->price_per_label_dpd) ? number_format($user->price_per_label_dpd,2) : 0.00}}</td>
                                            <?php $admin = \App\Models\User::select('username')->where('id', $user->create_by)->first();
                                            $self = 'Registerd by self';  ?>
                                            <td>
                                                @if($admin)
                                                    {{ $admin->username }}
                                                @else
                                                {{ $self }}
                                                @endif
                                            </td>
                                            <td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if (in_array('updateuser',$privileges) || Auth::user()->is_admin == 1)
                                                            <a class="edit dropdown-item"
                                                                href="{{route('users.edit',$user->id)}}">Edit</a>
                                                        @endif
                                                        @if($user->is_active != 1)
                                                            @if (in_array('activateeuser',$privileges) || Auth::user()->is_admin == 1)
                                                                <form method="post"
                                                                        action="{{url('users/activate',$user->id)}}">
                                                                    @csrf
                                                                    <button type="submit" class="important dropdown-item"
                                                                            style="cursor: pointer;">Activate
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            @if (in_array('deactivateeuser',$privileges) || Auth::user()->is_admin == 1)
                                                                <form method="post"
                                                                        action="{{url('users/deactivate',$user->id)}}">
                                                                    @csrf
                                                                    <button type="submit" class="important dropdown-item"
                                                                            style="cursor: pointer;">De-Activate
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                        <?php $email = $user->email; ?>
                                                        {{--<form method="post" action="{{route('users.destroy',$user->id)}}">--}}
                                                            {{--@csrf--}}
                                                            {{--@method('DELETE')--}}
                                                            {{--<button type="submit"--}}
                                                                    {{--onclick="return confirm('You are going to delete the user: {{$email}}. Do you want to Delete all BOL record or Data which this User Fetch from Bol ?')"--}}
                                                                    {{--class="dropdown-item delete"--}}
                                                                    {{--style="cursor: pointer;">Delete--}}
                                                            {{--</button>--}}
                                                        {{--</form>--}}
                                                        <a class="edit dropdown-item" href="{{route('users.show',$user->id)}}">View Report</a>

                                                    </div>
                                            </td>

                                                <!-- <div class="action-dropdown custom-dropdown-icon">
                                                    <div class="dropdown show">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                        id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1"></circle>
                                                                <circle cx="19" cy="12" r="1"></circle>
                                                                <circle cx="5" cy="12" r="1"></circle>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2"
                                                            x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(-150px, 21px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            @if (in_array('updateuser',$privileges) || Auth::user()->is_admin == 1)
                                                                <a class="edit dropdown-item"
                                                                href="{{route('users.edit',$user->id)}}">Edit</a>
                                                            @endif
                                                            @if($user->is_active != 1)
                                                                @if (in_array('activateeuser',$privileges) || Auth::user()->is_admin == 1)
                                                                    <form method="post"
                                                                        action="{{url('users/activate',$user->id)}}">
                                                                        @csrf
                                                                        <button type="submit" class="important dropdown-item"
                                                                                style="cursor: pointer;">Activate
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            @else
                                                                @if (in_array('deactivateeuser',$privileges) || Auth::user()->is_admin == 1)
                                                                    <form method="post"
                                                                        action="{{url('users/deactivate',$user->id)}}">
                                                                        @csrf
                                                                        <button type="submit" class="important dropdown-item"
                                                                                style="cursor: pointer;">De-Activate
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            @endif
                                                            <?php $email = $user->email; ?>
                                                            {{--<form method="post" action="{{route('users.destroy',$user->id)}}">--}}
                                                                {{--@csrf--}}
                                                                {{--@method('DELETE')--}}
                                                                {{--<button type="submit"--}}
                                                                        {{--onclick="return confirm('You are going to delete the user: {{$email}}. Do you want to Delete all BOL record or Data which this User Fetch from Bol ?')"--}}
                                                                        {{--class="dropdown-item delete"--}}
                                                                        {{--style="cursor: pointer;">Delete--}}
                                                                {{--</button>--}}
                                                            {{--</form>--}}
                                                            <a class="edit dropdown-item"
                                                            href="{{route('users.show',$user->id)}}">View Report</a>
                                                        </div>
                                                    </div>
                                                </div> -->


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

