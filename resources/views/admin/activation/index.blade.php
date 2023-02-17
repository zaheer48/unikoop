@extends('layouts.app')
@section('title','Activation')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
@php
$privileges = explode(",",\Auth::user()->privilages);
@endphp
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
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-body text-center">
                            <h4>Mollie Credential</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-5 offset-4">
                                    @php
                                    $mollie = \DB::table('payment_methods')->where('type','mollie_payment')->first();
                                    @endphp
                                    @if (in_array('activate_mollie',$privileges) || Auth::user()->is_admin == 1)
                                    <div class="btn-group btn-toggle" id="mollie_gateway">
                                        <input type="hidden" id="mollie_status" value="{{ ($mollie->status) ? 'ON' : 'OFF' }}">
                                        <button class="btn {{ ($mollie->status) ? 'btn-success active' : 'btn-default' }}">ON
                                        </button>
                                        <button class="btn {{ (!$mollie->status) ? 'btn-success active' : 'btn-default' }}">
                                            OFF
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-body">
                            <h4 class="text-center">Bank Transfer</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-5 offset-4">
                                    @php
                                    $bank = \DB::table('payment_methods')->where('type','bank_transfer')->first();
                                    @endphp
                                    @if (in_array('activate_btransfer',$privileges) || Auth::user()->is_admin == 1)
                                    <div class="btn-group btn-toggle" id="bank_transfer">
                                        <input type="hidden" id="bank_status" value="{{ ($bank->status) ? 'ON' : 'OFF' }}">
                                        <button class="btn {{ ($bank->status) ? 'btn-success active' : 'btn-default' }}">ON
                                        </button>
                                        <button class="btn {{ (!$bank->status) ? 'btn-success active' : 'btn-default' }}">OFF
                                        </button>
                                    </div>
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
<script>
    $('#mollie_gateway').click(function () {
        var status = $('#mollie_status').val();
        if (status == 'ON') {
            $.post('{{ url('/switch-activation') }}',
                {_token:'{{ csrf_token() }}', status: 0, type: 'mollie'},
                function (data) {
                    $('#mollie_status').val('OFF');});
        } else {
            $.post('{{ url('/switch-activation') }}',
                {
                    _token:'{{ csrf_token() }}', status: 1, type: 'mollie'},
                function (data) {
                    $('#mollie_status').val('ON');});
        }
    });

    $('#bank_transfer').click(function () {
        var status = $('#bank_status').val();
        if (status == 'ON') {
            $.post('{{ url('/switch-activation') }}',
                {
                    _token:'{{ csrf_token() }}', status: 0, type: 'bank'},
                function (data) {
                    $('#bank_status').val('OFF');});
        } else {
            $.post('{{ url('/switch-activation') }}',
                {
                    _token:'{{ csrf_token() }}', status: 1, type: 'bank'},
                function (data) {
                    $('#bank_status').val('ON');});
        }
    });

    $(".btn-toggle").click(function () {
        $(this).find(".btn").toggleClass("active");

        if ($(this).find(".btn-primary").length > 0) {
            $(this).find(".btn").toggleClass("btn-primary");
        }
        if ($(this).find(".btn-danger").length > 0) {
            $(this).find(".btn").toggleClass("btn-danger");
        }
        if ($(this).find(".btn-success").length > 0) {
            $(this).find(".btn").toggleClass("btn-success");
        }
        if ($(this).find(".btn-info").length > 0) {
            $(this).find(".btn").toggleClass("btn-info");
        }

        $(this).find(".btn").toggleClass("btn-default");
    });

    $("form").submit(function () {
        var radioValue = $("input[name='options']:checked").val();
        if (radioValue) {
            alert("You selected - " + radioValue);
        }
        return false;
    });
</script>
@endsection