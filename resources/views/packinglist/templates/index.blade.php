@extends('layouts.app')
@section('title', 'Packing List templates | Unikoop')
@section('css')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <!-- <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                                <li class="breadcrumb-item active">Responsive Table</li>
                                            </ol>
                                        </div> -->
                            <!-- <h4 class="page-title">All Orders</h4> -->
                            <h4 class="page-title" style="color: blue";>Packing List Templates</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        @if (Session::has('success'))
                        {{-- <p class="alert alert-success">{{ Session::get('success') }}
                            <a href="#" class="close" data-dismiss="alert"
                                aria-label="close">&times;</a>
                        </p> --}}
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('success') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                       @endif
                    @if (Session::has('alert-warning'))
                        {{-- <p class="alert alert-warning">{{ Session::get('alert-warning') }}
                            <a href="#" class="close" data-dismiss="alert"
                                aria-label="close">&times;</a>
                        </p> --}}
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('alert-warning') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="page-title" style="color: blue";>Packing List Templates</h4> --}}
                                <div class="responsive-table-plugin">

                                    <div class="table-rep-plugin">
                                        <!-- <div class="row">
                                                        <div class="col-md-7"></div>
                                                        <div class="col-md-4">
                                                            <select class="form-select">
                                                                <option selected>Open this select menu</option>
                                                                <option value="1">DHL</option>
                                                                <option value="2">DPD</option>
                                                                <option value="3">DHL Today</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="button" class="btn btn-primary width-xs waves-effect waves-light">Next</button>

                                                        </div>
                                                       </div> -->
                                        <div class="table-responsive">
                                            <table id="tech-companies-1 " class="table table-striped">
                                                <thead>
                                                    <tr>

                                                        <th>S.NO</th>
                                                        <th>Logo|</th>
                                                        <th>Logo||</th>
                                                        <th class="col-2">Footer Logo(s)</th>
                                                        <th class="col-2">Default</th>
                                                        <th class="col-3">Actions</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    <?php $i = 1; ?>
                                                    @foreach ($templates as $template)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            @if (!$template->logo_1)
                                                                Not set
                                                            @else
                                                                <img src="{{ asset('images/'.$template->logo_1) }}" alt="" style="max-width: 20% !important;">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$template->logo_2)
                                                                Not set
                                                            @else
                                                                <img src="{{ asset('images/'.$template->logo_2) }}" alt="" style="max-width: 20% !important;">
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
                                                        <td class="" >
                                                            <div class="d-flex mt-n1">
                                                                <a href="{{ route('packinglist-templates.edit',$template->id) }}" class="btn btn-sm btn-success d-flex mx-2 my-1">
                                                               <span><i class="fa fa-edit"></i>  Edit</span>
                                                                </a>
                                                                <a href="{{ url('/packlist-template-preview',$template->id) }}" target="_blank" class="btn btn-sm btn-primary  d-flex mx-2 my-1">
                                                                <span><i class="fa fa-eye"></i> Preview</span>

                                                                </a>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div> <!-- end .table-responsive -->
                                    </div> <!-- end .table-rep-plugin-->
                                </div> <!-- end .responsive-table-plugin-->



                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->
        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection
