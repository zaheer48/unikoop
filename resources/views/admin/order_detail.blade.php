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
            <div class="card-header mt-5">
                <h5 class="h5 text-black mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                            <table id="contactList" class="table-borderless table">
                                @foreach ($all_users as $list)
                                <tr>
                                    <td> Bestellnummer</td>
                                    <td>{{$list->bestelnummer}} </td>
                                </tr>
                                <tr>
                                    <td> Customer</td>
                                    <td>{{ $list->username }} </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $list->email }} </td>
                                </tr>
                                <tr>
                                    <td> Shipping address</td>
                                    <td>House No # {{$list->adres_verz_huisnummer}},
                                        Street No # {{$list->adres_verz_straat}},
                                        Street No Addition # {{$list->adres_verz_huisnummer_toevoeging}},
                                        Addition Address # {{$list->adres_verz_toevoeging}},
                                        Postal Code # {{$list->postcode_verzending}},
                                      </td>
                                </tr> 
                                @endforeach
                            </table>
                        </div>
                        <div class="col-6">
                            <table id="contactList" class="table-borderless table">
                                @foreach ($all_users as $list)
                                <tr>
                                    <td> Order date</td>
                                    <td>{{$list->besteldatum}} </td>
                                </tr>
                                <tr>
                                    <td> Order status</td>
                                    <td>{{$list->bol_update_status}} </td>
                                </tr>
                                <tr>
                                    <td> Total order amount:</td>
                                    <td>{{$list->prijs}} </td>
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