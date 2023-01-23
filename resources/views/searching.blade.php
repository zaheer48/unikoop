@extends('layouts.service_dashboard')
@section('title','Search Result | Unikoop')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(Session::has('danger'))
        <p class="alert alert-warning">{{ Session::get('danger') }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif

    <div class="col-md-10 bg-blue middlecontainer">


        <form name="all_data" action="{{ action('SiteController@searching') }}" method="post">


            <input type="hidden" name="all_checked" value="">

            <input type="hidden" name="_token" value="hICXWPMIjDSwBPc2NFXCKbzdzXkiPRn56zjPH4Qv">

            <input type="hidden" name="site" value="bol_nl">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="table-responsive">

                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>

                                    <th height="30"> ID</th>
                                    <th height="30"> BestelNummer</th>

                                    <th height="30"> BestelDatum</th>
                                    <th height="30"> voornaam_verzending</th>
                                    <th height="30"> achternaam_verzending</th>
                                    <th height="30"> Zip code</th>
                                    <th height="30"> Country Billing</th>
                                    <th height="30"> Street Address</th>
                                    <th height="30"> trackerCode</th>
                                    <th height="30"> Bol Status</th>
                                    <th height="30"> Email Status</th>
                                    <!-- <th height="30">City</th> -->
                                    <th height="30">packing list</th>

                                    <th height="30">Invoice</th>


                                </tr>
                                </thead>
                                <tbody>
                                @forelse($searchings as $search)
                                    <tr>
                                        <td height="30" style="">{{ $search->id }}</td>
                                        <td height="30" style="">{{ $search->bestelnummer }}</td>
                                        <td height="30" style="">{{ $search->besteldatum }}</td>
                                        <td height="30" style="">{{ $search->voornaam_verzending }}</td>
                                        <td height="30" style="">{{ $search->achternaam_verzending }}</td>
                                        <td height="30" style="">{{ $search->postcode_verzending }}</td>
                                        <td height="30" style="">{{ $search->land_facturatie }}</td>
                                        <td height="30" style="">{{ $search->adres_verz_straat }}</td>
                                        <td height="30" style="">

                                            @if($search->trackerCode)
                                                {{ $search->trackerCode }}
                                            @else
                                                N/A

                                            @endif

                                        </td>
                                        <td height="30" style=""></td>
                                        <td height="30"
                                            style="">@if ($search->email_status != 0){{ $search->email_status }}@endif</td>


                                        <td>
                                        <?php  $packing = \App\Bol_rec::where('id', $search->bol_rec_id)->first(); ?>

                                        <!-- <form method="get" action="{{ action('SiteController@searching') }}" accept-charset="UTF-8"> -->
                                            <!-- <form name="register" method="post" id="check_invoice_form2" action="" enctype="multipart/form-data" style="display:none"> -->
                                        <!-- {{ csrf_field() }} -->
                                            <input type="hidden" class="chk" value="{{ $search->bestelnummer }}"
                                                   name="bestelnummer" id="{{ $search->bestelnummer }}"
                                                   onclick="pakinglist(this.id)">
                                            <!-- </form> -->
                                            <!-- <a href="#" target="_blank" id="my-link" onclick="javascript:abc(this.id);">Google Chrome</a> -->

                                            <a style="display:none" href="" id="third_anchor{{$search->bestelnummer}}">Packing
                                                List</a>
                                            <a id="packingnone{{$search->bestelnummer}}" style="display:block">N/A</a>
                                        <!-- <a href="{{ route('bol.packlist',$search->bestelnummer) }}">Packing list</a> -->
                                            <!-- <button  class="btn btn-deafult" type="submit">Packing list</button>  -->

                                        </td>
                                        <td>

                                            <a style="display:none" href="" id="second_anchor{{$search->bestelnummer}}">invoice</a>
                                            <a id="invoicenone{{$search->bestelnummer}}" style="display:block">N/A</a>
                                        <!-- <a href="{{ url('/download-invoice-pdf',$search->bestelnummer) }}">Invoice</a>
    <a style="display:none" href="" id="f_anchor">Invoice</a>
                            <a style="display:none" href="" id="sf_anchor">Packing List</a>
                            <a style="display:none" href="" id="second_anchor">Invoice</a> -->
                                        </td>
                                    </tr>


                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                    <script>
                                        $(document).ready(function () {


                                            // set time out 5 sec
                                            $('.chk').trigger('click');

                                        });

                                    </script>
                                @empty
                                    <h4>No search result found...</h4>
                                @endforelse
                                </tbody>
                            </table>
                            {{ $searchings->links()  }}
                        </div>
                    </div>

                </div>
            </div>
        </form>


    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>


        function pakinglist(id) {
            var data = "/" + id;
            $.ajax({
                type: "post",
                url: '{{ URL::to('/bol/check_in1') }}' + data,
                dataType: "json",
                success: function (data) {
                    if (data.message == 'No record found against this Order ID') {
                        alert('No record found against this Order ID');
                    }

                    if (data.check_invoice_message == '2') {
                        // alert('hi');
                        //  $("#third_anchor").css("display","block");
                        var check_invoice_orderID = data.check_invoice_orderID;
                        $("#third_anchor" + check_invoice_orderID).attr("href", "/download-packinglist-pdf/" + check_invoice_orderID);
                        $("#third_anchor" + check_invoice_orderID).css("display", "block");
                        $("#packingnone" + check_invoice_orderID).css("display", "none");
                    }


                    if (data.check_invoice_message == '1') {
                        var check_invoice_orderID = data.check_invoice_orderID;
                        // $("#second_anchor" + check_invoice_orderID).attr("href", "/bol/create_invoice_2/" + check_invoice_orderID);
                        $("#second_anchor" + check_invoice_orderID).attr("href", "/download-invoice-pdf/" + check_invoice_orderID);
                        $("#second_anchor" + check_invoice_orderID).css("display", "block");
                        $("#invoicenone" + check_invoice_orderID).css("display", "none");
                    } else {
                        $("#second_anchor").css("display", "show");

                    }

                    if (data.check_invoice_message == '1-2') {
                        var check_invoice_orderID = data.check_invoice_orderID;
                        $("#second_anchor" + check_invoice_orderID).attr("href", "/download-invoice-pdf/" + check_invoice_orderID);
                        // $("#second_anchor" + check_invoice_orderID).attr("href", "/bol/create_invoice_2/" + check_invoice_orderID);
                        $("#third_anchor" + check_invoice_orderID).attr("href", "/download-packinglist-pdf/" + check_invoice_orderID);
                        $("#second_anchor" + check_invoice_orderID).css("display", "block");
                        $("#third_anchor" + check_invoice_orderID).css("display", "block");
                        $("#invoicenone" + check_invoice_orderID).css("display", "none");
                        $("#packingnone" + check_invoice_orderID).css("display", "none");
                    } else {

                        $("#second_anchor").css("display", "none");
                        $("#third_anchor").css("display", "none");
                    }


                }
            });
        }

    </script>
    <script>

        function searchMember() {

            var search = $('#search-field').val();
            if (search == '') {
                document.getElementById('search-field').style.border = "1px solid #CC3333";
                document.getElementById('search-field').focus();
            } else {
                document.getElementById('search-field').style.border = "1px solid #ced4da";
                var data = "search=" + search;
                // alert(data);
                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('searching') }}',
                    data: data,
                    success: function (data) {
                        // alert(data);
                        $('#main_section').hide();
                        document.getElementById('result-element').innerHTML = data;
                        document.getElementById('search-field').value = '';

                    }
                });
            }
        }

    </script>

@endsection