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
        <div class="card mt-5">
            <div class="card-header bg-white mx-5 mt-3">
                <h5 class="fs-4 text-black mb-0">Order Summary</h5>
            </div>
            <div class="card-body mx-5">
                        <div class="row">
                            <div class="col-6">
                            <table id="contactList" class="table">
                                @foreach ($all_users as $list)
                                <tr>
                                    <td class="text-black"> Bestellnummer</td>
                                    <td class="fs-5">{{$list->bestelnummer}} </td>
                                </tr>
                                <tr>
                                    <td class="text-black"> Customer</td>
                                    <td class="fs-5">{{ $list->username }} </td>
                                </tr>
                                <tr>
                                    <td class="text-black">Email</td>
                                    <td class="fs-5">{{ $list->email }} </td>
                                </tr>
                                <tr>
                                    <td class="text-black"> Shipping address</td>
                                    <td class="fs-5">House No # {{$list->adres_verz_huisnummer}},
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
                            <table id="contactList" class="table">
                                @foreach ($all_users as $list)
                                <tr>
                                    <td class="text-black"> Order date</td>
                                    <td class="fs-5">{{$list->besteldatum}} </td>
                                </tr>
                                <tr>
                                    <td class="text-black"> Order status</td>
                                    <td class="fs-5">{{$list->bol_update_status}} </td>
                                </tr>
                                <tr>
                                    <td class="text-black"> Total order amount</td>
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