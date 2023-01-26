@extends('layouts.service_dashboard')
@section('title','Invoice templates')
@section('content')
<div class="col-md-10 bg-blue middlecontainer">
    @if(Session::has('success'))
    <p class="alert alert-success">{{ Session::get('success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </p>
    @endif
    @if(Session::has('alert-warning'))
    <p class="alert alert-warning">{{ Session::get('alert-warning') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </p>
    @endif
    <div class="panel panel-info">
        <div class="row" style="margin-top: 8px;">
            <div class="col-md-12">
                <h3 style="padding: 20px;">Invoice Templates</h3>
                <hr>
                <div class="row" style="padding: 20px;">
                    <div class="col-md-12">
                        <style>
                        .table > thead > tr > th {
                        width: 100px;
                        }
                        </style>
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Logo I</th>
                                    <th>Logo II</th>
                                    <th>Footer Logo(s)</th>
                                    <th>Default</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($templates as $template)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if (!$template->logo_1)
                                        Not set
                                        @else
                                        <img src="{{ asset('images/'.$template->logo_1) }}" alt="" style="max-width: 50% !important;">
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$template->logo_2)
                                        Not set
                                        @else
                                        <img src="{{ asset('images/'.$template->logo_2) }}" alt="" style="max-width: 50% !important;">
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$template->footer_logos)
                                        Not set
                                        @else
                                        Configured
                                        @endif
                                    </td>
                                    <td>
                                        @if ($template->as_complete)
                                        @if ($template->as_default)
                                        <a class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;Default</a>
                                        @else
                                        <a href="{{ url('set-invoice-template-default',$template->id) }}" class="btn btn-sm btn-info">Set Default</a>
                                        @endif
                                        @else
                                        Not Configured
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('invoice-templates.edit',$template->id) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                        <a href="{{ url('/invoice-template-preview',$template->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                            Preview
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>  <th colspan="3"><h3 style="padding: 5px; text-align: center;">Bank 1</h3></th>
                                <th colspan="3"><h3 style="padding: 5px; text-align: center;">Bank 2</h3></th>
                                <th></th></tr>
                                <tr>
                                    <th>IBAN</th>
                                    <th>Bank Name</th>
                                    <th>BIC</th>
                                    <th>IBAN</th>
                                    <th>Bank Name</th>
                                    <th>BIC</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @if($servicebanks == null)
                                <tr>
                                 <td colspan="7"><p align="center">No record Found <br>
                                <a href="{{ route('service_bank.servicecreate') }}" class="btn btn-md btn-primary"
                                       style="text-align: center; margin-top: 10px;">Add Bank Service</a></p>
                                </td>

                                </tr>
                                @else
                                <tr>
                                    <td>{{ $servicebanks -> iban  }}</td>
                                    <td>{{ $servicebanks -> bank_name }}</td>
                                    <td>{{ $servicebanks -> bic }}</td>
                                    <td>
                                        @if (!$servicebanks -> iban_2)
                                        Not set
                                        @else
                                        {{ $servicebanks -> iban_2 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$servicebanks -> bank_name_2)
                                        Not set
                                        @else
                                        {{ $servicebanks -> bank_name_2 }}
                                        @endif
                                    </td>
                                    <td>@if (!$servicebanks -> bic_2)
                                        Not set
                                        @else
                                        {{ $servicebanks -> bic_2 }}
                                        @endif
                                    </td>
                                    <td><a href="{{ route('service_bank.service.edit',$servicebanks->slug) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection