@extends('layouts.service_dashboard')
@section('title','Service Bank')
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
                    <h3 style="padding: 20px;">
                        Service Bank
                         @if($service_banks == null)
                        <a href="{{ route('service_bank.create') }}" class="btn btn-md btn-primary"
                           style="float: right; margin-top: -10px;">Add Service Bank</a>
                        @else
                        <a href="{{ route('service_bank.edit',$service_banks->slug) }}" class="btn btn-md btn-primary"
                           style="float: right; margin-top: -10px;">Update Service Bank</a>
                        @endif
                    </h3>
                    <hr>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered" id="myTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Account</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th>International Account Number</th>
                                    <th>IBN</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                @if($service_banks == null)
                                <tr>
                                    <td colspan="8">No record Found</td>
                                </tr>
                                @else
                                <tr>
                                    <td>{{ $service_banks -> bank_name  }}</td>
                                    <td>{{ $service_banks -> bank_number }}</td>
                                    <td>{{ $service_banks -> bank_account_number }}</td>
                                    <td>{{ $service_banks -> bank_account_phone }}</td>
                                    <td>{{ $service_banks -> bank_account_email }}</td>
                                    <td>{{ $service_banks -> bank_account_location }}</td>
                                    <td>{{ $service_banks -> bank_account_number_international }}</td>
                                    <td>{{ $service_banks -> iban }}</td>
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
@section('js')
    <script>
        function deleteTemplate(id) {
            $('#template_id').val(id);
        }
    </script>
@endsection