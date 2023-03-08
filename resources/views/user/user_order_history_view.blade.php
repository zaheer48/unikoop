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
    @include('layouts.user_side_bar')
@endsection
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
            <div class="row justify-content-end">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header mt-5">
                            <h5 class="h5 text-black mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                        <table id="contactList" class="table-borderless table">
                                            @foreach ($user_bol_data as $list)
                                            <tr>
                                                <td> Bestellnummer</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            <tr>
                                                <td> Customer</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            <tr>
                                                <td> Shipping address</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table id="contactList" class="table-borderless table">
                                            @foreach ($user_bol_data as $list)
                                            <tr>
                                                <td> Order date</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            <tr>
                                                <td> Order status</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            <tr>
                                                <td> Total order amount:</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            <tr>
                                                <td>Shipping method</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td>Payment method</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            @endforeach
                                        </table>
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
        $(document).ready(function(){
    $("#userWallet_filter input").removeClass("form-control-sm");
    $("#userWallet_filter input").after('<button type="button" class="btn btn-primary" style="float: right;"><i class="fas fa-search"></i></button>');
});
    </script>