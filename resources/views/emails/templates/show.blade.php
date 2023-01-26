@extends('layouts.service_dashboard')
@section('title','Template Details')
@section('content')

    <div class="col-md-10 bg-blue middlecontainer">
        <div class="panel panel-info">
            <div class="row" style="margin-top: 8px;">
                <div class="col-md-12">
                    <h3 style="padding: 20px;">
                        Template Details
                        <a href="{{ route('email-templates.index') }}" class="btn btn-md btn-primary" style="float: right; margin-top: -10px;">Email Templates</a>
                    </h3>
                    <hr>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-6">
                            <p>
                                <strong>Type:</strong> {{ $template->email_type }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12">
                            <p>
                                {!! $template->email_body !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection