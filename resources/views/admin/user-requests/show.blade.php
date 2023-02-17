@extends('layouts.app')
@section('title','Request Details')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')

    @php
        $privileges = explode(",",\Auth::user()->privilages);
    @endphp
    <style>
        p {
            margin-bottom: 15px !important;
        }

        h4 {
            font-weight: bolder;
        }
    </style>
    <div class="content-page">
        <div class="content">
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    $username = \App\Models\User::where('id', $user_request->user_id)->first();
                    $bussiness_data = \App\Models\BussinessAddress::where('register_id', $username->id)->first();
                    $data = json_decode($user_request->data);
                    ?>
                    <h3>
                        Request Details
                        <a class="btn btn-primary" href="{{route('user_requests.index')}}" style="float: right;">Back</a>
                        @if (in_array('activate_user_request',$privileges) || Auth::user()->is_admin == 1)
                            <form method="post" action="{{route('user_requests.update',$user_request->id)}}" style="float: right;">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                        onclick="return confirm('You are going to Approve the user: {{$username->username}} data. Do you want to proceed ?')"
                                        data-toggle="tooltip" data-original-title="approve" style="margin-right: 5px;"
                                        class="btn btn-success">
                                    <i class="glyphicon glyphicon-ok"></i> Approve
                                </button>
                            </form>
                        @endif
                        @if (in_array('de_activate_user_request',$privileges) || Auth::user()->is_admin == 1)
                            <form method="post" action="{{route('user_requests.destroy',$user_request->id)}}"
                                style="float: right;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('You are going to Reject the user: {{$username->username}} data. Do you want to proceed ?')"
                                        data-toggle="tooltip" data-original-title="reject" style="margin-right: 5px;"
                                        class="btn btn-danger">
                                    <i class="glyphicon glyphicon-remove"></i> Reject
                                </button>
                            </form>
                        @endif
                    </h3>
                    <hr>
                    @if($user_request->type == 'BussinessInfo-change')
                        @if($bussiness_data ?? '')
                            <h4>
                                <mark>Old Business Data:</mark>
                            </h4>
                            <br>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Username: <strong>
                                    {{$username->username}}
                                </strong>
                            </p>
                            <p>
                                Straat: <strong>
                                    <mark style="{{ ($bussiness_data->street != $data->street) ? 'background: yellow;' : 'background: transparent' }}">{{ $data->street }}</mark>
                                </strong>
                            </p>
                            <p>
                                Postcode: <strong>
                                    <mark style="{{ ($bussiness_data->postcode != $data->postcode) ? 'background: yellow;' : 'background: transparent' }}">{{ $data->postcode }}</mark>
                                </strong>
                            </p>
                            <p>
                                Provincie: <strong>
                                    <mark style="{{ ($bussiness_data->county != $data->county) ? 'background: yellow' : 'background: transparent' }}">{{ $data->county }}</mark>
                                </strong>
                            </p>
                            <p>
                                Telefoonnummer: <strong>
                                    <mark style="{{ ($bussiness_data->phonenumber != $data->pnumber) ? 'background: yellow' : 'background: transparent' }}">{{ $data->pnumber }}</mark>
                                </strong>
                            </p>
                            <p>
                                Email sales: <strong>
                                    <mark style="{{ ($bussiness_data->email_sales != $data->email_sale) ? 'background: yellow' : 'background: transparent' }}">{{ $data->email_sale }}</mark>
                                </strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                Huisnummer: <strong>
                                    <mark style="{{ ($bussiness_data->h_b_number != $data->housebuildname) ? 'background: yellow' : 'background: transparent' }}">{{ $data->housebuildname }}</mark>
                                </strong>
                            </p>
                            <p>
                                Stad / plaats: <strong>
                                    <mark style="{{ ($bussiness_data->city_town != $data->citytown) ? 'background: yellow' : 'background: transparent' }}">{{ $data->citytown }}</mark>
                                </strong>
                            </p>
                            <p>
                                Land: <strong>
                                    <mark style="{{ ($bussiness_data->country != $data->kycBusinessInfo_Country) ? 'background: yellow' : 'background: transparent' }}">{{ $data->kycBusinessInfo_Country }}</mark>
                                </strong>
                            </p>
                            <p>
                                Work Phone: <strong>
                                    <mark style="{{ ($bussiness_data->workphone != $data->wnumber) ? 'background: yellow' : 'background: transparent' }}">{{ $data->wnumber }}</mark>
                                </strong>
                            </p>
                            <p>
                                Email admin: <strong>
                                    <mark style="{{ ($bussiness_data->email_admin != $data->emailadmin) ? 'background: yellow' : 'background: transparent' }}">{{ $data->emailadmin }}</mark>
                                </strong>
                            </p>
                            <p>
                                Mobile number: <strong>
                                    <mark style="{{ ($bussiness_data->mobilephone != $data->mnumber) ? 'background: yellow' : 'background: transparent' }}">{{ $data->mnumber }}</mark>
                                </strong>
                            </p>
                        </div>
                    </div>
                        @endif
                        <hr>
                        <h4>
                            <mark>Requested Business Data:</mark>
                        </h4>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    Username: <strong>
                                        {{$username->username}}
                                    </strong>
                                </p>
                                <p>
                                    Straat: <strong>
                                        <mark style="{{ ($bussiness_data->street != $data->street) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->street }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Postcode: <strong>
                                        <mark style="{{ ($bussiness_data->postcode != $data->postcode) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->postcode }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Provincie: <strong>
                                        <mark style="{{ ($bussiness_data->county != $data->county) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->county }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Telefoonnummer: <strong>
                                        <mark style="{{ ($bussiness_data->phonenumber != $data->pnumber) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->pnumber }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Email sales: <strong>
                                        <mark style="{{ ($bussiness_data->email_sales != $data->email_sale) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->email_sale }}</mark>
                                    </strong>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    Huisnummer: <strong>
                                        <mark style="{{ ($bussiness_data->h_b_number != $data->housebuildname) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->housebuildname }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Stad / plaats: <strong>
                                        <mark style="{{ ($bussiness_data->city_town != $data->citytown) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->citytown }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Land: <strong>
                                        <mark style="{{ ($bussiness_data->country != $data->kycBusinessInfo_Country) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->kycBusinessInfo_Country }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Work Phone: <strong>
                                        <mark style="{{ ($bussiness_data->workphone != $data->wnumber) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->wnumber }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Email admin: <strong>
                                        <mark style="{{ ($bussiness_data->email_admin != $data->emailadmin) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->emailadmin }}</mark>
                                    </strong>
                                </p>
                                <p>
                                    Mobile number: <strong>
                                        <mark style="{{ ($bussiness_data->mobilephone != $data->mnumber) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->mnumber }}</mark>
                                    </strong>
                                </p>
                            </div>
                        </div>
                    @elseif($user_request->type == 'wallet_recharge')
                        @php
                            $transaction = \DB::table('transaction_histories')->where('id',$data->transaction_id)->first();
                            $summary = json_decode($transaction->summary);
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <h4>
                                    <mark>User Details:</mark>
                                </h4>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <p>Username: <strong>{{ $username->username }}</strong></p>
                                <p>User Description: <strong>{{ $data->description }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p>E-Mail: <strong>{{ $username->email }}</strong></p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    <mark>Payment Details:</mark>
                                </h4>
                                <br>
                            @if(!empty($summary) && $summary->payment_method != 'Bank Transfer')
                                <p>Description: <strong>{{ $summary->description }}</strong></p>
                                <p>Payment ID: <strong>{{ $summary->payment_id }}</strong></p>
                                <p>Amount <strong>{{ $summary->amount }}</strong></p>
                                <p>Currency <strong>{{ $summary->currency }}</strong></p>
                                <p>Payment Method <strong>{{ $summary->payment_method }}</strong></p>
                                <p>Created at <strong>{{ $summary->created_at }}</strong></p>

                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <mark>Card Details:</mark>
                                </h4>
                                <br>
                                <p>Card Number <strong>{{ $summary->card_number }}</strong></p>
                                <p>Card Holder <strong>{{ $summary->card_holder }}</strong></p>
                                <p>Card Audience <strong>{{ $summary->card_audience }}</strong></p>
                                <p>Card Label <strong>{{ $summary->card_label }}</strong></p>
                                <p>Country Code <strong>{{ $summary->country_code }}</strong></p>
                                <p>Paid at <strong>{{ $summary->paid_at }}</strong></p>
                            </div>
                        </div>
                        @else
                        <p>Description: <strong>{{ $summary->description }}</strong></p>
                        <p>Payment ID: <strong>{{ $summary->payment_id }}</strong></p>
                        <p>Amount <strong>{{ $summary->amount }}</strong></p>
                        <p>Payment Method <strong>{{ $summary->payment_method }}</strong></p>
                        <p>Created at <strong>{{ $summary->paid_at }}</strong></p>

                        @endif
                    @elseif($user_request->type == 'profile-change')
                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    <mark>User Details:</mark>
                                </h4>
                                <br>
                                <p>Username: <strong style="{{ ($username->username != $data->username) ? 'background: yellow;' : 'background: transparent' }}">{{ $username->username }}</strong></p>
                                <p>E-Mail: <strong style="{{ ($username->email != $data->email) ? 'background: yellow;' : 'background: transparent' }}">{{ $username->email }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <mark>Requested Details:</mark>
                                </h4>
                                <br>
                                <p>User: <strong>
                                        <mark style="{{ ($username->username != $data->username) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->username }}</mark>
                                    </strong></p>
                                <p>E-Mail: <strong>
                                    <mark style="{{ ($username->email != $data->email) ? 'background: #d9534f; color: #fff;' : 'background: transparent' }}">{{ $data->email }}</mark>
                                    </strong></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection





























