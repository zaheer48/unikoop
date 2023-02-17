@extends('layouts.app')
@section('title','Website Settings')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
    @php
        $privileges = explode(",",\Auth::user()->privilages);
    @endphp
    <style type="text/css">
        .remove {
            position: absolute;
            margin-top: 15px;
            left: 16px;
            background-color: red;
            padding: 5px 10px;
            border-radius: 30px;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
    <div class="content-page">
        <div class="content">
            @if (session()->has('success'))
                <div class="alert alert-dismissable alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        {!! session()->get('success') !!}
                    </strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-body">
                                <h4 class="">
                                    Website Settings
                                    @if (in_array('updatsetting',$privileges) || Auth::user()->is_admin == 1)
                                        <a href="{{ url('/update-site-settings') }}" class="btn btn-primary"
                                        style="float: right;">Update Settings</a>
                                    @endif
                                </h4>
                                <br>
                                @php
                                    $settings = \DB::table('website_settings')->first();
                                @endphp
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Site Title</h4>
                                        <h2>{{ $settings->site_title }}</h2>
                                    </div>
                                    <div class="col-md-3">
                                        <h4>Fav Icon</h4>
                                        <img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_fav_icon) : '' }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <h4>Site Logo</h4>
                                        <img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_logo) : '' }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Partners Logos</h3>
                                        <br>
                                    </div>
                                    @if($settings->partners_logo != null)
                                        @php
                                            $files = explode(",",$settings->partners_logo);
                                        @endphp
                                        @foreach($files as $files => $value)
                                            <div class="col-md-3" style="margin-bottom: 10px;">
                                        <span style="position: relative;" id="{{ $value }}">
                                            @if (in_array('deletesetting_image',$privileges) || Auth::user()->is_admin == 1)
                                            <small class="remove" onclick="removePartner('{{ $value }}','partner')">X</small>
                                            @endif
                                            <img src="{{ asset('portal/'.$value) }}" class="img-fluid">
                                        </span>
                                            </div>
                                            <br>
                                        @endforeach
                                    @endif
                                    
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Services Logos</h3>
                                        <br>
                                    </div>
                                    @if($settings->services_logo != null)
                                        @php
                                            $files = explode(",",$settings->services_logo);
                                        @endphp
                                        @foreach($files as $files => $value)
                                            <div class="col-md-3" style="margin-bottom: 10px;">
                                        <span style="position: relative;" id="{{ $value }}">
                                            @if (in_array('deletesetting_image',$privileges) || Auth::user()->is_admin == 1)
                                            <small class="remove" onclick="removePartner('{{ $value }}','service')">X</small>
                                            @endif
                                            <img src="{{ asset('portal/'.$value) }}" class="img-fluid">
                                        </span>
                                            </div>
                                            <br>
                                        @endforeach
                                    @endif
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function removePartner(id, type) {
            $.post('{{ url('/delete-partner') }}', {
                _token: '{{ csrf_token() }}',
                value: id,
                type: type
            }, function (data) {
                document.getElementById(data).style.display = 'none';
            });
        }

    </script>
@endsection