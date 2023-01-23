@extends('layouts.service_dashboard')
@section('title','Fetched Labels')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection
@section('content')

    <div class="col-md-10 bg-blue middlecontainer">
        <div class="panel panel-info">
            <div class="row" style="margin-top: 8px;">
                <div class="col-md-12">
                    <div class="container">
                        <h3 style="padding: 20px;">Fetched Labels</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default" id="main_section">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="myTable" style="width:100%">
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
                                                @foreach($labels as $row)
                                                    <tr>
                                                        <td height="30">{{ $row->id }}</td>
                                                        <td height="30">
                                                            @php
                                                            $products = \DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $row->bestelnummer)->get();                                                            
                                                            @endphp
                                                            @foreach($products as $product)
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
                                                            <a target="_blank" href="{{ asset('pdf_files/'.$row->lable_pdf) }}"
                                                               class="btn btn-sm btn-primary">
                                                                <i class="fa fa-file-pdf-o"></i> PDF
                                                            </a>
                                                        </td>
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
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                responsive: true,
            });
        });
    </script>

@endsection