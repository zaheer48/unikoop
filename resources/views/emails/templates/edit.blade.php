@extends('layouts.service_dashboard')
@section('title','Edit Email Template')
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
                        Template Details
                        <a href="{{ route('email-templates.index') }}" class="btn btn-md btn-primary" style="float: right; margin-top: -10px;">Email Templates</a>
                    </h3>
                    <hr>
                    <form class="form-horizontal" action="{{ url('/email-templates',$template->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="blood_group_display_name">Email Type <small style="color:red;">*</small></label>
                            <div class="col-sm-8">
                                <select name="email_type" id="blood_group_display_name" class="form-control" required style="height: 36px;">
                                    <option value="Order Invoice">
                                        Order Invoice
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="blood_group_slug">Email Body <small style="color:red;">*</small></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="email_body" id="edit_profile_description" rows="18" style="resize: vertical;" placeholder="Enter Faq Description">
                                    {!! $template->email_body !!}
                                </textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group add-product-footer text-center">
                            <button name="addProduct_btn" type="submit" class="btn btn-primary product-btn">
                                Update Email Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <link href="{{asset('assets/css/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/summernote.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#edit_profile_description').summernote({
                height: 350
            });
        });
    </script>

@endsection