@extends('layouts.app')
@section('title','Label Pricing')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
{{-- <style>
      #sidebar-menu>ul>li>a {
            transition: none;

            font-size: inherit;
        }
    </style> --}}

    @php
        $privileges = explode(",",\Auth::user()->privilages);
    @endphp
    <div class="content-page">
        <div class="content">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-body">
                        <h3>
                            Label Pricing
                            @if (in_array('add_edit_labprice',$privileges) || Auth::user()->is_admin == 1)
                                <a href="{{url('/label-pricing/create')}}" class="btn btn-sm btn-primary" style="float: right;">
                                    Add/Edit Label Pricing
                                </a>
                            @endif
                        </h3>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-dismissable alert-success">
                                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>

                                </button>
                                <strong>
                                    {{ session('success')}}
                                </strong>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h3>DHL</h3>
                                @if($dhl)
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>DHL Original Price</td>
                                            <td>&euro;{{ $dhl->dhl_original_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>DHL Unikoop Price</td>
                                            <td>&euro;{{ $dhl->dhl_unikoop_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>DHL Discount Price</td>
                                            <td>&euro;{{ $dhl->dhl_discount_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>DHL Active Price</td>
                                            <td>{{ $dhl->is_active }}</td>
                                        </tr>
                                        <tr>
                                            <td>DHL Discount Note</td>
                                            <td>{{ $dhl->dhl_discount_note }}</td>
                                        </tr>
                                        <tr>
                                            <td>Max</td>
                                            <td>{{ $dhl->box_size }}</td>
                                        </tr>
                                        <tr>
                                            <td>Levering</td>
                                            <td>{{ $dhl->delivery }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>Label pricing is not added.</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h3>DPD</h3>
                                @if($dpd)
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>DPD Original Price</td>
                                            <td>&euro;{{ $dpd->dpd_original_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>DPD Unikoop Price</td>
                                            <td>&euro;{{ $dpd->dpd_unikoop_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>DPD Discount Price</td>
                                            <td>&euro;{{ $dpd->dpd_discount_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>DPD Active Price</td>
                                            <td>{{ $dpd->is_active }}</td>
                                        </tr>
                                        <tr>
                                            <td>DPD Discount Note</td>
                                            <td>{{ $dpd->dpd_discount_note }}</td>
                                        </tr>
                                        <tr>
                                            <td>Max</td>
                                            <td>{{ $dpd->box_size }}</td>
                                        </tr>
                                        <tr>
                                            <td>Levering</td>
                                            <td>{{ $dpd->delivery }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>Label pricing is not added.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
