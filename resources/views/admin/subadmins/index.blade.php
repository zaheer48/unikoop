@extends('layouts.app')
@section('title','SubAdmins')
@section('sidebar')
    @include('layouts.admin_side_bar')
@endsection
@section('content')
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
    </style>
    @php
        $privileges = explode(",",\Auth::user()->privilages);
    @endphp
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <style>
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
    <div class="card shadow">
        <div class="card-body">
            <div class="card-body">
                <h3>
                    Sub Admins List
                    @if (in_array('add_sadmins',$privileges) || Auth::user()->is_admin == 1)
                        <a href="{{route('subadmins.create')}}" class="btn btn-primary" style="float: right;">
                            Create Sub Admin
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
                            <th scope="col">Created By</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sno = 1; ?>
                        @if(count($subadmins) > 0)
                            @foreach($subadmins as $subadmin)
                                <tr>
                                    <td>{{ $subadmin->email }}</td>
                                    <td>{{ $subadmin->password_hint }}</td>
                                    <td>
                                        @if($subadmin->is_active == 0)
                                            <span class="badge badge-pill badge-danger">De-active</span>
                                            @else
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @endif
                                    </td>
                                    <?php $admin = \App\Models\User::select('username')->where('id', $subadmin->create_by)->first();?>
                                    <td>
                                        @if($admin)
                                            {{ $admin->username }}
                                        @endif
                                    </td>
                                    <td>{{$subadmin->created_at->format('d/m/y')}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2" x-placement="bottom-start" style="position: absolute; transform: translate3d(-150px, 21px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            @if (in_array('edit_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                <a class="edit dropdown-item"
                                                    href="{{route('subadmins.edit',$subadmin->id)}}">Edit</a>
                                            @endif
                                            @if($subadmin->is_active != 1)
                                                @if (in_array('activate_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                    <form method="post"
                                                            action="{{url('subadmins/activate',$subadmin->id)}}">
                                                        @csrf
                                                        <button type="submit" class="important dropdown-item"
                                                                style="cursor: pointer;">Activate
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                @if (in_array('de_activate_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                    <form method="post"
                                                            action="{{url('subadmins/deactivate',$subadmin->id)}}">
                                                        @csrf
                                                        <button type="submit" class="important dropdown-item"
                                                                style="cursor: pointer;">De-Activate
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                            @if (in_array('delete_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                <form method="post" action="{{route('subadmins.destroy',$subadmin->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <?php $email = $subadmin->email; ?>
                                                    <button type="submit"
                                                            onclick="return confirm('You are going to delete the user: {{$email}}. Do you want to Delete ?')"
                                                            class="dropdown-item delete"
                                                            style="cursor: pointer;">Delete
                                                    </button>
                                                </form>
                                            @endif
                                            <a class="edit dropdown-item" href="{{route('subadmins.show',$subadmin->id)}}">View details</a>
                                        </div>

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
                                                    @if (in_array('edit_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                        <a class="edit dropdown-item"
                                                           href="{{route('subadmins.edit',$subadmin->id)}}">Edit</a>
                                                    @endif
                                                    @if($subadmin->is_active != 1)
                                                        @if (in_array('activate_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                            <form method="post"
                                                                  action="{{url('subadmins/activate',$subadmin->id)}}">
                                                                @csrf
                                                                <button type="submit" class="important dropdown-item"
                                                                        style="cursor: pointer;">Activate
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        @if (in_array('de_activate_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                            <form method="post"
                                                                  action="{{url('subadmins/deactivate',$subadmin->id)}}">
                                                                @csrf
                                                                <button type="submit" class="important dropdown-item"
                                                                        style="cursor: pointer;">De-Activate
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                    @if (in_array('delete_sadmins',$privileges) || Auth::user()->is_admin == 1)
                                                        <form method="post"
                                                              action="{{route('subadmins.destroy',$subadmin->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <?php // $email = $subadmin->email; ?>
                                                            <button type="submit"
                                                                    onclick="return confirm('You are going to delete the user: {{$email}}. Do you want to Delete ?')"
                                                                    class="dropdown-item delete"
                                                                    style="cursor: pointer;">Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a class="edit dropdown-item"
                                                       href="{{route('subadmins.show',$subadmin->id)}}">View details</a>
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

@endsection
@section('js')

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable();
        });
    </script>
@endsection

