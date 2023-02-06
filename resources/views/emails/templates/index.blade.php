@extends('layouts.app')
@section('title', 'Email templates | Unikoop')
@section('content')





    {{-- <div class="card col-md-10  middlecontainer mt-5">
        @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif

        @if (Session::has('alert-warning'))
            <p class="alert alert-warning">{{ Session::get('alert-warning') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif

        <div class="panel panel-info">
            <div class="row" style="margin-top: 8px;">
                <div class="col-md-12">
                    <h3 style="padding: 20px;">
                        Email Templates
                        <a href="{{ route('email-templates.create') }}" class="btn btn-md btn-primary"
                            style="float: right; margin-top: -10px;">Add Template</a>
                    </h3>
                    <hr>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $template->email_type }}</td>
                                            <td>
                                                @if ($template->status == 1)
                                                    <a class="btn btn-sm btn-success"><i
                                                            class="fa fa-check"></i>&nbsp;Default</a>
                                                @else
                                                    <a href="{{ url('/email-templates-default', $template->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        Set Default
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('email-templates.show', $template->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Show</a>
                                                <a href="{{ route('email-templates.edit', $template->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                <button type="button" data-toggle="modal" data-target="#deleteTemplate"
                                                    onclick="deleteTemplate('{{ $template->id }}')"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
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

    <div class="modal fade" id="deleteTemplate" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Template</h4>
                </div>
                <div class="modal-body">
                    Are you sure to delete template?
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/email-templates/delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="template_id" name="id">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

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
                            <div class="page-title-right">
                                {{-- <form class="d-flex align-items-center mb-3">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control border" id="dash-daterange">
                                        <span class="input-group-text bg-blue border-blue text-white">
                                            <i class="mdi mdi-calendar-range"></i>
                                        </span>
                                    </div>
                                    <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                        <i class="mdi mdi-autorenew"></i>
                                    </a>
                                    <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                        <i class="mdi mdi-filter-variant"></i>
                                    </a>
                                </form> --}}
                            </div>
                            <h4 class="page-title" style="color:blue">Email Templates</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                @endif

                @if (Session::has('alert-warning'))
                    <p class="alert alert-warning">{{ Session::get('alert-warning') }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                @endif
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
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="page-title" style="color: blue;">Email Tempelate</h4> --}}
                                <a href="{{ route('email-templates.create') }}" class="btn btn-md btn-primary"
                                    style="float: right; margin-top: -10px;">Add Template</a>
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
                                        {{-- <div class="table-responsive"> --}}
                                        <table id="tech-companies-1 " class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>S.No</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>


                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                <?php $i = 1; ?>
                                                @foreach ($templates as $template)
                                                    <tr>

                                                        <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
                                                        <td>{{ $i++ }}</td>

                                                        <td>{{ $template->email_type }}</td>
                                                        <td>
                                                            @if ($template->status == 1)
                                                                <a class="btn btn-sm btn-success"><i
                                                                        class="fa fa-check"></i>&nbsp;Default</a>
                                                            @else
                                                                <a href="{{ url('/email-templates-default', $template->id) }}"
                                                                    class="btn btn-sm btn-info">
                                                                    Set Default
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('email-templates.show', $template->id) }}"
                                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>
                                                                Show</a>
                                                            <a href="{{ route('email-templates.edit', $template->id) }}"
                                                                class="btn btn-sm btn-success"><i class="fa fa-edit"></i>
                                                                Edit</a>
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#deleteTemplate"
                                                                onclick="deleteTemplate('{{ $template->id }}')"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    {{-- </div> <!-- end .table-responsive --> --}}
                                </div> <!-- end .table-rep-plugin-->
                            </div> <!-- end .responsive-table-plugin-->



                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div><!-- container -->
    </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


@endsection
@section('js')
    <script>
        function deleteTemplate(id) {
            $('#template_id').val(id);
        }
    </script>
@endsection
