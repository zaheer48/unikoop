@extends('layouts.app')
@section('title','Users Requests')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')

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
    </style>
    <div class="content-page">
        <div class="content">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-body">
                        <h3>
                            Users Requests List
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

                            <table class="table align-items-center table-flush" id="userrequestsTable">
                                <thead class="theadmin-light">
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Type</th>
                                    
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($user_requests) > 0)
                                    @foreach($user_requests as $user_request)
                                        <tr>
                                            <?php $username = \App\Models\User::where('id', $user_request->user_id)->first();  ?>
                                            <td>{{ $username->username }}</td>
                                            <td>{{ $username->email }}</td>
                                            <td>
                                                <?php
                                                    switch ($user_request->type) {
                                                        case 'BussinessInfo-change';
                                                        echo 'Business Info Update';
                                                        break;
                                                        case 'wallet_recharge';
                                                        echo 'Wallet Recharged';
                                                        break;
                                                        case 'profile-change';
                                                        echo 'Profile Change';
                                                        break;
                                                    }
                                                ?>
                                            </td>
                                        
                                            <td style="display: inline-flex;">
                                                <button class="btn btn-sm"
                                                        style="background: transparent; margin-top: -6px;margin-right: -14px;">
                                                    <a href="{{route('user_requests.show',$user_request->id)}}" class="edit" title="" data-toggle="tooltip" data-original-title="view"><i class="glyphicon glyphicon-eye-open btn btn-sm btn-primary"></i></a>
                                                </button>
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
            $('#userrequestsTable').DataTable();
        });
    </script>
@endsection

