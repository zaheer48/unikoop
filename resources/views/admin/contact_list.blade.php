@extends('layouts.app')
@section('title','Dashboard')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <style>
        #wrapper{
    height: auto!important;
}
        </style>
@endsection
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
            <div class="row justify-content-end">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="responsive-table-plugin mt-5">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive">
                                        <table id="contactList" class="table table-striped mt-5">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>No of Orders</th>
                                                <th>View Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_users as $list)
                                            <tr>
                                                <td>{{$list->username}}</td>
                                                <td>{{$list->phone}}</td>
                                                <td>{{$list->email}}</td>
                                                <td>{{$list->address}}</td>
                                                <td>{{$list->total_orsers}}</td>
                                                <td><a href="{{ route('user.orders', $list->id) }}"><button class="btn btn-info"><i class="fa-regular fa-eye"></i></button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
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
        $(document).ready(function() {
            $('#userWallet').DataTable();
        });
    </script>
    <script>
        // $('.form-control-sm').remove();
        $(document).ready(function(){
    // var input = $('#userWallet_filter label input');
    // $("#userWallet_filter label").html('');
    // $("#userWallet_filter label").append(input);
    $("#userWallet_filter input").removeClass("form-control-sm");
    $("#userWallet_filter input").after('<button type="button" class="btn btn-primary" style="float: right;"><i class="fas fa-search"></i></button>');
    // $("#userWallet_filter input").attr("placeholder", "Search");
});
    </script>