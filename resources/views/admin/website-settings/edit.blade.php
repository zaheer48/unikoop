@extends('layouts.app')
@section('title','Update Website Settings')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
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
            @if($errors->any())
                <ul class="alert alert-warning"
                    style="background: #eb5a46; color: #fff; font-weight: 300; line-height: 1.7; font-size: 16px; list-style-type: circle;">
                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                </ul>
            @endif
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-body">
                                <h4 class="">
                                    Update Website Settings
                                </h4>
                                <br>
                                <form action="{{ url('/update-site-settings') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @php
                                        $settings = \DB::table('website_settings')->first();
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="">Site Title</label>
                                                <small style="color: red;"> *</small>
                                                <input type="text" name="site_title" value="@if($settings) {{ $settings->site_title }} @endif" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="">Site Logo</label>
                                                <small style="color: red;"> *</small>
                                                <input type="file" name="site_logo" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="">Fav Icon</label>
                                                <small style="color: red;"> *</small>
                                                <input type="file" name="site_fav_icon" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="">Partners Logos</label>
                                                <small style="color: red;"> Can be multiple</small>
                                                <input type="file" name="files[]" class="form-control" multiple>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="">Services Logos</label>
                                                <small style="color: red;"> Can be multiple</small>
                                                <input type="file" name="services[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                    </div>


                                    {{--   <div class="col-xl-12 col-md-12 col-sm-12">
                                            <div class="custom-file-container" data-upload-id="mySecondImage">
                                                <label>Partners Logos</label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="files[]" multiple>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                            <div class="custom-file-container" data-upload-id="servicesImage">
                                                <label>Services Logos</label>
                                                <label class="custom-file-container__custom-file">
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="services[]" multiple>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-3">
                                                <button class="btn btn-primary mt-3">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- @section('js')
    <script type="text/javascript" src="{{ asset('css/file-upload-with-preview.min.js') }}"></script>
    <script type="text/javascript">
        var firstUpload = new FileUploadWithPreview('mySecondImage');
        var secondUpload = new FileUploadWithPreview('servicesImage');
    </script>
@endsection --}}
