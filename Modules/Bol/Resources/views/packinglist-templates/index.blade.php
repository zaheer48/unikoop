@extends('layouts.service_dashboard')
@section('title','Packing List templates')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
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
                    <h3 style="padding: 20px;">Packing List Templates</h3>
                    <hr>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12">
                            <style>
                                .table > thead > tr > th {
                                    width: 100px;
                                }
                            </style>
                            <table class="table table-hover table-bordered">
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
                                                    <a href="{{ url('set-packlist-template-default',$template->id) }}" class="btn btn-sm btn-info">Set Default</a>
                                                @endif
                                            @else
                                                Not Configured
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('packinglist-templates.edit',$template->id) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>
                                            <a href="{{ url('/packlist-template-preview',$template->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                                Preview
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

@endsection