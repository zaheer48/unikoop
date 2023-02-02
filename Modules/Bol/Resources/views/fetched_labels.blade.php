@extends('layouts.app')
@section('title', 'Fetched Labels | Unikoop')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatables.min.css') }}">
@endsection
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
    <div class="content-page">
        <div class="content">


            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                {{-- <form class="d-flex align-items-center mb-3">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control border" id="dash-daterange">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                    <i class="mdi mdi-autorenew"></i>
                                </a>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                    <i class="mdi mdi-filter-variant"></i>
                                </a>
                            </form> --}}
                            </div>
                            <h4 class="page-title" style="color: blue">Fetched Label</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="col-12 col-md-12 card middlecontainer">
                    <div class="panel panel-info">
                        <div class="row" style="margin-top: 8px;">
                            <div class="col-md-12">
                                <div class="container">
                                    {{-- <h3 style="padding: 20px;color: blue">Fetched Labels</h3> --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <div class="panel panel-default" id="main_section">
                                    <div class="panel-body">
                                        <div class="table-responsive"> --}}
                                            {{-- <table class="table table-hover table-bordered" id="myTable" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th height="30">Id</th>
                                                    <th height="30">Product</th>
                                                    <th height="30">BestelNummer</th>
                                                    <th height="30">Voornaam</th>
                                                    <th height="30">Achternaam</th>
                                                    <th height="30">Tracker Code</th>
                                                    <th height="30">Logistiek</th>
                                                    <th height="30">Prijs</th>
                                                    <th height="30">Download</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($labels as $row)
                                                    <tr>
                                                        <td height="30">{{ $row->id }}</td>
                                                        <td height="30">
                                                            @php
                                                            $products = \DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $row->bestelnummer)->get();
                                                            @endphp
                                                            @foreach ($products as $product)
                                                            <b>EAN</b>: {{ $product->EAN }}<br />
                                                            <b>Prijs</b>: {{ $product->prijs }}<br />
                                                            <b>Referentie</b>: {{ $product->referentie }}<br />
                                                            <b>Product</b>: {{ $product->producttitel }}<br />
                                                            <b>Aantal</b>: {{ $product->aantal }}
                                                            @endforeach
                                                        </td>
                                                        <td height="30">{{ $row->bestelnummer }}</td>
                                                        <td height="30">{{ $row->voornaam_verzending }}</td>
                                                        <td height="30">{{ $row->achternaam_verzending }}</td>
                                                        <td height="30">{{ $row->trackerCode }}</td>
                                                        <td height="30">{{ $row->logistiek }}</td>
                                                        <td height="30">
                                                            @if ($row->price_charged)
                                                                &euro;{{ number_format($row->price_charged,2) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td height="30">
                                                            <a target="_blank" href="{{ Module::asset('bol:pdf_files/' . $row->lable_pdf) }}"
                                                               class="btn btn-sm btn-primary">
                                                                <i class="fe-file-plus"></i> PDF
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table> --}}

                                            <div class="responsive-table-plugin">
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive">
                                                        <div class="row">
                                                            <div class="col-4"></div>
                                                            <div class="col-3"></div>
                                                            {{-- <div class="col-5" >
                                                                <div class="input-group" >
                                                                    <div class="form-outline" style="margin-left: 70px;">
                                                                      <input type="search" id="form1" class="form-control" />

                                                                    </div>
                                                                    <button type="button" class="btn btn-primary" style="float: right;">
                                                                      <i class="fas fa-search"></i>
                                                                    </button>
                                                                  </div>
                                                            </div> --}}
                                                        </div>
                                                        <table id="tech-companies-1" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Product</th>
                                                                    <th>BestelNummer</th>
                                                                    <th>Voornaam</th>
                                                                    <th>Achternaam</th>
                                                                    <th>Tracker Code</th>
                                                                    <th>Logistiek</th>
                                                                    <th>Prijs</th>
                                                                    <th>Download</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($labels as $row)
                                                                    <tr>
                                                                        <td>{{ $row->id }}</td>
                                                                        <td>
                                                                            @php
                                                                                $products = \DB::table('bol_data')
                                                                                    ->select('id', 'EAN', 'aantal', 'producttitel', 'prijs', 'referentie')
                                                                                    ->where('bestelnummer', $row->bestelnummer)
                                                                                    ->get();
                                                                            @endphp
                                                                            @foreach ($products as $product)
                                                                                <b>EAN</b>: {{ $product->EAN }}<br />
                                                                                <b>Prijs</b>: {{ $product->prijs }}<br />
                                                                                <b>Referentie</b>:
                                                                                {{ $product->referentie }}<br />
                                                                                <b>Product</b>:
                                                                                {{ $product->producttitel }}<br />
                                                                                <b>Aantal</b>: {{ $product->aantal }}
                                                                            @endforeach
                                                                        </td>
                                                                        <td>{{ $row->bestelnummer }}</td>
                                                                        <td>{{ $row->voornaam_verzending }}</td>
                                                                        <td>{{ $row->achternaam_verzending }}</td>
                                                                        <td>{{ $row->trackerCode }}</td>
                                                                        <td>{{ $row->logistiek }}</td>
                                                                        <td>
                                                                            @if ($row->price_charged)
                                                                                &euro;{{ number_format($row->price_charged, 2) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <a target="_blank"
                                                                                href="{{ Module::asset('bol:pdf_files/' . $row->lable_pdf) }}"
                                                                                class="btn btn-sm btn-primary">
                                                                                <i class="fe-file-plus"></i> PDF
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>



                                                        </table>
                                                    </div> <!-- end .table-responsive -->

                                                </div> <!-- end .table-rep-plugin-->
                                            </div> <!-- end .responsive-table-plugin-->
                                            {{-- </div>
                                    </div>
                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{ URL::asset('assets/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
            });
        });
    </script>

@endsection
