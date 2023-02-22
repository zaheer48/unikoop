@extends('layouts.app')
@section('title', 'Invoice templates | Unikoop')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
<style>
   .sticky-table-header>.table>thead>tr>th, .sticky-table-header>.table>tbody>tr>th, .sticky-table-header>.table>tfoot>tr>th, .sticky-table-header>.table>thead>tr>td, .sticky-table-header>.table>tbody>tr>td, .sticky-table-header>.table>tfoot>tr>td {
    white-space: normal;
}
</style>
    <!-- Start Page Content here -->
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
                            <h4 class="page-title" style="color: blue">Invoice Template</h4>
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
                                {{-- <h4 class="page-title" style="color: blue";>Invoice Tempelate</h4> --}}
                                <div class="responsive-table-plugin">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
                                                        <th>S.NO</th>
                                                        <th>Logo|</th>
                                                        <th>Logo||</th>
                                                        <th class="col-2">Footer Logo(s)</th>
                                                        <th>Default</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    <?php $i = 1; ?>
                                                    @foreach ($templates as $template)
                                                        <tr>
                                                            <td>
                                                                {{ $i++ }}
                                                            </td>

                                                            <td>
                                                                @if (!$template->logo_1)
                                                                    Not set
                                                                @else
                                                                    <img src="{{ asset('images/' . $template->logo_1) }}"
                                                                        alt="" style="max-width: 30% !important;">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (!$template->logo_2)
                                                                    Not set
                                                                @else
                                                                    <img src="{{ asset('images/' . $template->logo_2) }}"
                                                                        alt="" style="max-width: 30% !important;">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (!$template->footer_logos)
                                                                    Not set
                                                                @else
                                                                    Configured
                                                                @endif
                                                            </td>
                                                            <td class="col-2">
                                                                @if ($template->as_complete)
                                                                    @if ($template->as_default)
                                                                        <a class="btn btn-sm btn-success">
                                                                            <i class="fa-solid fa-check"></i>
                                                                            &nbsp;Default
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('invoice-templates.setDefault', $template->id) }}" class="btn btn-sm btn-info">
                                                                            <i class="fa-solid fa-check"></i> 
                                                                            Set Default
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                 Not Configured
                                                                @endif
                                                            </td>

                                                            <td class="col-3">
                                                                <div class="d-flex gap-2">
                                                                    <a href="{{ route('invoice-templates.edit', $template->id) }}"
                                                                        class="btn btn-sm btn-success">
                                                                        <i class="fa fa-edit"></i>  Edit
                                                                    </a>
                                                                    <a href="{{ route('invoice-templates.show', $template->id) }}"
                                                                        target="_blank" class="btn btn-sm btn-primary">
                                                                        <i class="fa fa-eye"></i>  Preview
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
                                <div class="row mt-5">
                                    <div class="col-6">
                                        <h4 style="color: blue"; class="text-center ">Bank1</h4>
                                        <div class="responsive-table-plugin">
                                            <div class="table">
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
                                                                <th>IBAN</th>
                                                                <th class="col-3">Bank Name</th>
                                                                <th>BIC</th>
                                                                <th class="col-3">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="">
                                                            @if ($servicebanks == null)
                                                                <tr>
                                                                    <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
                                                                    <td colspan="4">
                                                                        <p align="center">No record Found <br>
                                                                            <a href="{{ route('service-bank.create') }}"
                                                                                class="btn btn-md btn-primary"
                                                                                style="text-align: center; margin-top: 10px;">Add
                                                                                Bank Service</a>
                                                                        </p>
                                                                    </td>
                                                                    <!-- <td>  <button type="button" class="btn btn-success width-xs waves-effect waves-light">
                                                                        <span class="btn-label"><i class="mdi mdi-check"></i></span>Default
                                                                    </button></td>
                                                                    <td>
                                                                            <button type="button" class="btn btn-primary width-xs waves-effect waves-light" aria-haspopup="true" aria-expanded="false">Edit</button>
                                                                            <button type="button" class="btn btn-primary width-xs waves-effect waves-light">Preview</button>
                                                                    </td> -->
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    {{-- <td>{{ $servicebanks -> iban  }}</td>
                                                            <td>{{ $servicebanks -> bank_name }}</td>
                                                            <td>{{ $servicebanks -> bic }}</td> --}}
                                                                    <td>
                                                                        @if (!$servicebanks->iban_2)
                                                                            Not set
                                                                        @else
                                                                            {{ $servicebanks->iban_2 }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (!$servicebanks->bank_name_2)
                                                                            Not set
                                                                        @else
                                                                            {{ $servicebanks->bank_name_2 }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (!$servicebanks->bic_2)
                                                                            Not set
                                                                        @else
                                                                            {{ $servicebanks->bic_2 }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('service-bank.edit', $servicebanks->id) }}"
                                                                            class="btn btn-sm btn-success">
                                                                            <i class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end .table-responsive -->
                                            </div> <!-- end .table-rep-plugin-->
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                    <div class="col-6">
                                        <h4 style="color: blue"; class="text-center mt-1">Bank2</h4>
                                        <div class="responsive-table-plugin">
                                            <div class="table">
                                                <div class="table-responsive">
                                                    <table id="tech-companies-1 " class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>IBAN</th>
                                                                <th class="col-3">Bank Name</th>
                                                                <th>BIC</th>
                                                                <th class="col-3">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="">
                                                            @if ($servicebanks == null)
                                                                <tr>
                                                                    <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
                                                                    <td colspan="4">
                                                                        <p align="center">No record Found <br>
                                                                            <a href="{{ route('service-bank.create') }}"
                                                                                class="btn btn-md btn-primary"
                                                                                style="text-align: center; margin-top: 10px;">Add
                                                                                Bank Service</a>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>
                                                                        @if (!$servicebanks->iban)
                                                                            Not set
                                                                        @else
                                                                            {{ $servicebanks->iban }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (!$servicebanks->bank_name)
                                                                            Not set
                                                                        @else
                                                                            {{ $servicebanks->bank_name }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (!$servicebanks->bic)
                                                                            Not set
                                                                        @else
                                                                            {{ $servicebanks->bic }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('service-bank.edit', $servicebanks->id) }}" class="btn btn-sm btn-success">
                                                                            <i class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end .table-responsive -->
                                            </div> <!-- end .table-rep-plugin-->
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <!-- End Page content -->
@endsection
