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
            background-color: transparent;
            /* padding: 0px 5px; */
            border-radius: 30px;
            color:  red;
            cursor: pointer;
            /* box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; */
        }
    </style>
    <div class="content-page">
        <div class="content">
            @if (session()->has('success'))
                <div class="alert alert-dismissable alert-success mt-2">
                    <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
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
                                <div class="row border shadow-lg col-12" style="border-radius:5px">
                                    <div class="siteTitle row mx-2 my-2 col">
                                    <div class="col-md-3 col-lg-3 border  col-xl-3 col-sm-3 my-2 mx-1">
                                        <h4>Site Title</h4>
                                        <h2 class="my-2 px-4 py-4 shadow-lg">{{ $settings->site_title }}</h2>
                                    </div>
                                    <div class="col-md-3 col-lg-3 border  col-xl-3 col-sm-3 my-2 mx-1">
                                        <h4>Fav Icon</h4>
                                        <div class="shadow-lg">
                                        <img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_fav_icon) : '' }}" class="img-fluid mx-2 my-2 shadow" alt="" style="
                                        height: 75px;
                                    ">
                                    </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 border  col-xl-3 col-sm-3 my-2 mx-1">
                                        <h4>Site Logo</h4>
                                        <div class="shadow-lg">
                                        <img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_logo) : '' }}" class="img-fluid mx-2 my-2 shadow" alt="" style="
                                        height: 75px;
                                        ">
                                        </div>

                                    </div>
                                </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h3>Partners Logos</h3>

                                </div>
                                <div class="row shadow-lg border" style="border-radius:5px">
                                 <div class="row col logos mb-3 mx-2">

                                    @if($settings->partners_logo != null)
                                        @php
                                            $files = explode(",",$settings->partners_logo);
                                        @endphp
                                        @foreach($files as $files => $value)

                                        <div class="border col-md-3 col-xl-2 col-sm-3 mt-5 mx-1 py-4 shadow-lg" style="margin-bottom: 10px;border-radius:5px">
                                        <span style="position: relative;" id="{{ $value }}">
                                            @if (in_array('deletesetting_image',$privileges) || Auth::user()->is_admin == 1)
                                            <small   class="mt-n4 mx-n4 remove" onclick="removePartner('{{ $value }}','partner')"><i class="fa-regular fa-circle-xmark"></i></small>
                                            @endif
                                            <img src="{{ asset('portal/'.$value) }}" class="img-fluid" style="
                                            height: 75px;
                                                            ">
                                         </span>
                                         </div>

                                            <br>
                                        @endforeach
                                    @endif
                                   </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h3>Services Logos</h3>

                                </div>
                                <div class="row border shadow-lg" style="
                                border-radius: 5px;
                            ">
                                 <div class="row m-2 col">
                                    @if($settings->services_logo != null)
                                        @php
                                            $files = explode(",",$settings->services_logo);
                                        @endphp
                                        @foreach($files as $files => $value)
                                            <div class="col-md-3 col-xl-2 col-sm-3 mt-5 mx-1 border shadow-lg py-4" style="margin-bottom: 10px; border-radius:5px">
                                        <span style="position: relative;" id="{{ $value }}">
                                            @if (in_array('deletesetting_image',$privileges) || Auth::user()->is_admin == 1)
                                            <small class="mt-n4 mx-n4 remove" onclick="removePartner('{{ $value }}','service')"><i class="fa-regular fa-circle-xmark"></i></small>
                                            @endif
                                            <img src="{{ asset('portal/'.$value) }}" class="img-fluid" style="
                                            height: 75px; width: 160px;

                                        ">
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
