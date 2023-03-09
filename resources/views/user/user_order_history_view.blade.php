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
                        <div class="card-header bg-white mt-5">
                            <h5 class="fs-4 text-black mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                        <table id="contactList" class="table-borderless table">
                                            @foreach ($user_bol_data as $list)
                                            <tr>
                                                <td class="fw-bold"> Bestellnummer</td>
                                                <td class="fs-5">{{$list->bestelnummer}} </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold"> Customer</td>
                                                <td class="fs-5">{{ Auth::user()->username }} </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Email</td>
                                                <td class="fs-5">{{ Auth::user()->email }} </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold"> Shipping address</td>
                                                <td class="fs-5">House No # {{$list->adres_verz_huisnummer}}
                                                    Street No # {{$list->adres_verz_straat}}
                                                    Street No Addition # {{$list->adres_verz_huisnummer_toevoeging}}
                                                    Addition Address # {{$list->adres_verz_toevoeging}}
                                                    Postal Code # {{$list->postcode_verzending}}
                                                  </td>
                                            </tr> 
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table id="contactList" class="table-borderless table">
                                            @foreach ($user_bol_data as $list)
                                            <tr>
                                                <td class="fw-bold"> Order date</td>
                                                <td class="fs-5">{{$list->besteldatum}} </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold"> Order status</td>
                                                <td class="fs-5">{{$list->bol_update_status}} </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold"> Total order amount:</td>
                                                <td class="fs-5">{{$list->prijs}} </td>
                                            </tr>
                                            {{-- <tr>
                                                <td>Shipping method</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td>Payment method</td>
                                                <td>{{$list->bestelnummer}} </td>
                                            </tr> --}}
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