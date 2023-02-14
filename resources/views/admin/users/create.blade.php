@extends('layouts.app')
@section('title','Create User')
@section('sidebar')
    @include('layouts.admin_side_bar')
@endsection
@section('content')

<script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    } </script>
<!-- bootstarp-css -->
<link href="/css/bootstrap.css?1564436599" rel="stylesheet" type="text/css" media="all"/>
<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="/js/jquery.min.js"></script>
<script src="/js/myjquery.js"></script>

<script src="/js/nav.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!--// bootstarp-css -->
<!-- css -->

<link rel="stylesheet"
      href="/css/style.css?1546443064" type="text/css" media="all"/>
<!--// css -->

<!--fonts-->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
      rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700'
      rel='stylesheet' type='text/css'>
<!--/fonts-->
<!-- dropdown -->
<script src="/js/jquery.easydropdown.js?1564436599"></script>
<link href="/css/nav.css?1572371412" rel="stylesheet" type="text/css" media="all"/>
<script src="/js/scripts.js?1564436599" type="text/javascript"></script>
<!-- seller_regist jquery -->
<script src="/js/seller_regist/script.js?1564436599" type="text/javascript"></script>
<script src="/js/seller_regist/return_shipping.js?1564436599" type="text/javascript"></script>
<?php
// $user = DB::table('users')->latest('id')->where('create_by','!=','NULL')->first();
// $user1 = \Session::get('user_id');
$user1 = Auth::user()->id;
if ($user1 ?? '') {
    $userId = $user1;
    $userrecord = DB::table('users')->where('id', $userId)->first();
    $user = DB::table('bussiness_address')->where('register_id', $userId)->first();

    $reg_business = DB::table('bussines')->where('register_id', $userId)->first();

    $business_owner = DB::table('business_owner')->where('seller_id', $userId)->get();
    //print_r($business_owner);

    $business_register_contact = DB::table('register_contact')->where('register_id', $userId)->first();
    //print_r($business_register_contact);

    $term_con = DB::table('users')->where('id', $userId)->first();

    $bank_detail = DB::table('bankdetail')->where('user_id', $userId)->first();

    $return_shipping = DB::table('return_shipping')->where('seller_id', $userId)->first();

    $charge_method = DB::table('charge_method')->where('register_id', $userId)->first();
    $settings = DB::table('setting')->where('userid', $userId)->first();
    $selling_plan = DB::table('selling_plan_regist')->where('register_id', $userId)->first();
} else {
    $userId = '';
    $selling_plan = '';
    $charge_method = '';
    $return_shipping = '';
    $bank_detail = '';
    $term_con = '';
    $business_owner = '';
    $reg_business = '';
    $user = '';
    $userrecord = '';
    $business_register_contact = '';
}
?>
<div class="content-page">
    <div class="content">
        <div class="row page-titles">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item"><a>Create User</a></li>
                </ol>
            </div>
        </div>

        <div class="card card-profile shadow">
            <div class="card-body">
                <h3>Users
                    <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" style="float: right;">
                        Finish User Settings
                    </a>
                </h3>
                <hr class="my-4">
                <form id="first_form" method="post" action="{{url('/store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="category_name">User Email</label>
                                <small style="color: red;"> *</small>
                                <input type="email" name="email" @if($userrecord) value="{{$userrecord->email}}" disabled @else
                                    value="{{old('email')}}" @endif id="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="User Email" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>
                        <div class="col-md-5">

                            <div class="form-group">
                                <label for="category_name">User Password</label>
                                <small style="color: red;"> *</small>
                                <input type="text" id="pass" min="8" @if($userrecord) value="{{$userrecord->password_hint}}"
                                    disabled @else value="{{old('password')}}" @endif name="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="User Password" required>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">


                            <div class="form-group">
                                <label for="category_name">Username</label>
                                <small style="color: red;"> *</small>
                                <input type="text" id="username" @if($userrecord) value="{{$userrecord->username}}" disabled
                                    @else value="{{old('username')}}" @endif name="username"
                                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    placeholder="Username" required>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group" id="adding-form">
                                <button type="submit" @if($userrecord) disabled @endif class="btn btn-md btn-primary">
                                    Create User
                                </button>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>

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
@if (session()->has('error'))
<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>
        {!! session()->get('error') !!}
    </strong>
</div>
@endif
<style>
    #close {
        cursor: pointer;
        position: absolute;
        top: 50%;
        right: 0%;
        padding: 12px 16px;
        transform: translate(0%, -50%);
        color: red;
    }
</style>
<div id="second_card" style="">
    <form action="/adminBussiness" name="bussinesss" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" id="contact_total" name="contact_total" value="0">
        <?php echo csrf_field(); ?>
        <input type="hidden" class="form-control" name="user_id" value="<?= $userId; ?>">
        <div class="about-left sting" id="businessandcontact" style="display:block;">
            <div class="panel panel-default">
                <div class="panel-body panel-body-multi">
                    <div class="row">
                        <div class="col-md-12">

                            <h3>Account Informatie</h3>

                            <div class="panel-body">
                                <br>
                                <br>
                                <p style="font-size: 16px;">is dit een geregistreerd bedrijf</p>
                                <?php
                                $entity_check = "";
                                $entity_check1 = "checked";
                                if (isset($reg_business->entity_id)) {
                                    $entity_check = "checked";
                                    $entity_check1 = "";
                                } else {
                                    $entity_check = "";
                                    $entity_check1 = "checked";
                                }
                                ?>
                                <input type="radio" id="show" value="1" <?= $entity_check ?> name="bid" required>yes


                                <input type="radio" id="hides" <?= $entity_check1 ?> value="0" name="bid">No
                                <br/>
                                <div class="box" id="box">
                                    <p style="font-size: 15px;">Registreer je namens een bedrijf (inclusief Britse
                                        eenmanszaken)?</p>

                                    <input type="radio" id="shows" value="1" name="prop_s">yes
                                    <input type="radio" id="hid" value="0" checked="" name="prop_s">No
                                </div>

                                <br/><br/>

                                <div class="box2" id="box2">
                                    <p><input type="checkbox" value="1" name="confirm_reg"></p>
                                    <p class="text-danger" style="font-size: 13px;">Houd er rekening mee dat deze optie
                                        niet in de toekomst kan worden gewijzigd. Het kiezen van een verkeerde optie kan
                                        leiden tot het verwijderen van uw verkooprechten.</p>
                                </div>

                                <?php
                                $entity_id = "";
                                $entity_id1 = "";
                                $entity_id2 = "";
                                $busines_owner = "";
                                $entity = "";
                                if (isset($reg_business->entity_id)) {
                                    $entity = $reg_business->entity_id;
                                    $busines_owner = $reg_business->bussines_owner;
                                    if ($reg_business->entity_id == 1) {
                                        $entity_id = "checked";
                                    } elseif ($reg_business->entity_id == 2) {
                                        $entity_id1 = "checked";
                                    } elseif ($reg_business->entity_id == 3) {
                                        $entity_id2 = "checked";
                                    }
                                }
                                ?>

                                <?php
                                $sub_entity_id1 = "";
                                $sub_entity_id2 = "";
                                $sub_entity_id3 = "";
                                $sub_entity_id4 = "";
                                $sub_entity_id5 = "";
                                $sub_entity_id6 = "";
                                $sub_entity_id7 = "";
                                $subentity = "";

                                if (isset($reg_business->sub_enity_id)) {
                                    $subentity = $reg_business->sub_enity_id;
                                    if ($reg_business->sub_enity_id == 1) {
                                        $sub_entity_id1 = "checked";

                                    } elseif ($reg_business->sub_enity_id == 2) {

                                        $sub_entity_id2 = "checked";

                                    } elseif ($reg_business->sub_enity_id == 3) {

                                        $sub_entity_id3 = "checked";

                                    } elseif ($reg_business->sub_enity_id == 4) {

                                        $sub_entity_id4 = "checked";

                                    } elseif ($reg_business->sub_enity_id == 5) {

                                        $sub_entity_id5 = "checked";

                                    } elseif ($reg_business->sub_enity_id == 6) {

                                        $sub_entity_id6 = "checked";

                                    } elseif ($reg_business->sub_enity_id == 7) {

                                        $sub_entity_id7 = "checked";
                                    }
                                    //echo $reg_business->sub_entity_id."hello";
                                }
                                ?>


                                <div class="entity" id="enityies">
                                    <p style="font-size: 16px;">Selecteer Juridische entiteit</p>
                                    <div class="panel-body">

                                        <div class="col-md-1">
                                            <input type="radio" id="enitys" class="enitys" <?= $entity_id ?>
                                                   name="entity" value="1">
                                        </div>

                                        <div class="col-md-11">
                                            <span>Bedrijf</span>
                                            <p>
                                                <div id="sub_entity1" <?= $sub_entity_id1 ?> class="sub_enity">

                                            <p>

                                                <input type="radio" <?= $sub_entity_id1 ?> name="subentity"
                                                       value="1">
                                                eenmanszaak
                                            </p>

                                            <p>

                                                <input type="radio" <?= $sub_entity_id2 ?> name="subentity"
                                                       value="2">
                                                V.O.F.
                                            </p>

                                            <p>

                                                <input type="radio" <?= $sub_entity_id3 ?> name="subentity"
                                                       value="3">
                                                maatschapij,B.V., N.V
                                            </p>
                                        </div>
                                        </p>

                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-1">
                                        <input type="radio" class="enitys" <?= $entity_id1 ?> name="entity" value="2">
                                    </div>

                                    <div class="col-md-11">
                                        <span>Vereiniging</span>
                                        <p>
                                            <div id="sub_entity2" class="sub_enity">

                                        <p>

                                            <input type="radio" <?= $sub_entity_id4 ?> name="subentity"
                                                   value="4">
                                            Maatschappelijk, sociaal
                                        </p>

                                        <p>

                                            <input type="radio" <?= $sub_entity_id5 ?> name="subentity"
                                                   value="5">
                                            vereniging van eigenaren
                                        </p>
                                    </div>
                                    </p>

                                </div>
                                <div class="clearfix"></div>

                                <div class="col-md-1">
                                    <input type="radio" class="enitys" <?= $entity_id2 ?> name="entity" value="3">
                                </div>

                                <div class="col-md-11">
                                    <span>Stichting</span>
                                    <p>
                                        <div id="sub_entity3" class="sub_enity">

                                    <p>

                                        <input type="radio" <?= $sub_entity_id6 ?> name="subentity"
                                               value="6">
                                        Maatschappelijk, sociaal
                                    </p>

                                    <p>

                                        <input type="radio" <?= $sub_entity_id7 ?> name="subentity"
                                               value="7">
                                        doeleind
                                    </p>
                                </div>
                                </p>

                            </div>
                            <div class="clearfix"></div>
                            <p class="text-danger">Houd er rekening mee dat deze optie niet in de toekomst kan worden
                                gewijzigd. Het kiezen van een verkeerde optie kan leiden tot het verwijderen van uw
                                verkooprechten.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>

<div class="panel panel-default" id="comp_detail">
    <div class="panel-body panel-body-multi">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Bedrijfs wettelijke naam:</span>
                        <?php if (isset($business_register_contact->legal_name)) { ?>
                            <input type="text" class="form-control" name="lename"
                                   value="<?= $business_register_contact->legal_name ?>" id="lname" disabled>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('lename') ? ' is-invalid' : '' }}"
                                   name="lename" value="{{ old('lename') }}" id="lname">
                            @if ($errors->has('lename'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lename') }}</strong>
                            </span>
                            @endif

                        <?php } ?>

                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <span>Business Entity Type</span>
                        <?php if (isset($business_register_contact->b_enti_type)) { ?>
                            <input type="text" name="entype" value="<?= $business_register_contact->b_enti_type ?>"
                                   class="form-control" placeholder="<?= $business_register_contact->b_enti_type ?>"
                                   id="email" disabled>
                        <?php } else { ?>
                            <input type="text" name="entype" value="{{ old('entype') }}" class="form-control"
                                   placeholder="e.g Ltd., PLC, Gmbh, S.a r.l., etc." id="email">
                        <?php } ?>
                    </div>


                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <span>K.V.K nummer:</span>
                        <?php if (isset($business_register_contact->b_reg_number)) { ?>
                            <input type="number" name="creg_num" value="<?= $business_register_contact->b_reg_number ?>"
                                   class="form-control" placeholder="<?= $business_register_contact->b_reg_number ?>"
                                   id="" disabled>
                        <?php } else { ?>
                            <input type="number" name="creg_num" value="{{ old('creg_num') }}"
                                   class="form-control{{ $errors->has('creg_num') ? ' is-invalid' : '' }}"
                                   placeholder="K.V.K nummer" id="">
                            @if ($errors->has('creg_num'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('creg_num') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-4">
                    <div class="form-group">
                        <span>Datum Business was geregistreerd:</span>
                        <?php if (isset($business_register_contact->b_reg_date)) { ?>
                            <input id="demo1" name="da_bregiste" class="form-control" type="date" size="25"
                                   value="<?php echo($business_register_contact->b_reg_date) ?>" disabled>
                        <?php } else { ?>
                            <input id="demo1" name="da_bregiste" class="form-control" type="date" size="25" value="{{ old('da_bregiste') }}">
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <span>K.V.K. Uittreksel: <small>(only pdf file is allowed)</small></span>
                        <input name="pdf_file" type="file" class="form-control{{ $errors->has('pdf_file') ? ' is-invalid' : '' }}">
                        @if ($errors->has('pdf_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pdf_file') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="clearfix"></div>
                <p class="padding-botom" style="font-size: 14px;
">Zorg ervoor dat de bovenstaande gegevens overeenkomen met de gegevens op het juiste
                    bedrijfsregistratiecertificaat.</p>
                <div class="col-md-4 padding-botom" style="
width: 300px;
">
                    <div class="form-group">
                        <span>Aantal Aandeelhouders / eigenaren:</span>
                        <input type="hidden" id="contact_total" value="0">
                        <select name="NumBeneficiaryOwners" id="NumBeneficiaryOwners" value="" class="form-control"
                                onchange="number_owners()">
                            <option value="" selected="selected">select</option>
                            <?php
                            for ($i = 1; $i < 6; $i++) {
                                $selecteed = "";
                                if ($busines_owner == $i)
                                    $selecteed = "selected";
                                echo "<option value='" . $i . "'  " . $selecteed . ">" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <p style="font-size: 12px;">Aandeelhouders / eigenaren zijn natuurlijke personen die het rechtstreeks of
                    indirecte eigendom bezitten of beheersen met meer dan 20% of meer van de aandelen of stemrechten van
                    de onderneming of van een andere natuurlijke persoon die anderszins controle over het beheer van de
                    onderneming uitoefent. Zorg ervoor dat u de vereiste informatie voor alle Aandeelhouders / eigenaren
                    hebt ingevuld. </p>

            </div>
        </div>
    </div>
</div>


<div class="panel panel-default" id="individual">
    <div class="panel-body panel-body-multi">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <span>Bedrijfs wettelijke naam:</span>
                        <input type="text" class="form-control" value="" name="clname2">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <span>UTR nummer</span>
                        <input type="text" name="urtnum" value="" class="form-control"
                               placeholder="Unique Taxpayer Reference number">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <span>Bedrijfsregistratie</span><br/>
                        <input type="checkbox" name="isBusinessRegistered" value="agree" class="onRegisteredChange"
                               id="isBusinessRegistered_id">
                        <span>Dit bedrijf is geregistreerd bij HM Revenue & Customs</span>

                    </div>
                </div>
                <div class="col-md-4" id="dbreg">
                    <div class="form-group">
                        <span></span>
                        <input id="dateb" name="dateregister" value="" type="text" size="25"><a
                                href="javascript:NewCal('dateb','ddmmyyyy')"><img
                                    src="https://unikoop.nl/templates/default//images/cal.gif" width="16" height="16"
                                    border="0" alt="Pick a date"></a>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>
</div>


<div class="panel panel-default" id="row_data">
    <div class="panel-body panel-body-multi">
        @if($business_owner ?? '')
        <div class="col-md-12" id="roww">
            <?php
            $i = 0;
            // if($business_owner ?? '') {
            foreach ($business_owner as $b_own) {
                # code...
                $gender = $b_own->gender;
                $first_name = $b_own->first_name;
                $mid_name = $b_own->mid_name;
                $lastname = $b_own->lastname;

                ?>
                <div class="row" style="display: inline;">
                    <span>Contact info:</span>
                    <br>
                    <div class="col-md-2">
                        <div class="form-group">
                            <span>Gender</span>
                            <select class="form-control" name="gender<?= $i ?>" style="height: 34px;">
                                <option value="Mr">Mr</option>
                                <option value="mrs">Mrs</option>
                                <option value="miss">Miss</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <span> First name</span>
                            <div class="form-group">
                                <input type="text"
                                       class="form-control{{ $errors->has('first_name'.$i) ? ' is-invalid' : '' }}"
                                       name="firstName<?= $i ?>" @if($first_name) value="<?= $first_name ?>" disabled
                                       @else value="{{ old('firstName'.$i) }}" @endif>
                                @if ($errors->has('first_name'.$i))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name'.$i) }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <span>Mid name</span>
                            <div class="form-group">
                                <input type="text" @if($mid_name) value="<?= $mid_name ?>" disabled @else
                                       value="{{ old('MidName'.$i) }}" @endif
                                       class="form-control{{ $errors->has('MidName'.$i) ? ' is-invalid' : '' }}"
                                       name="MidName<?= $i ?>"
                                       @if($mid_name) value="<?= $mid_name ?>" disabled @endif>
                                @if ($errors->has('MidName'.$i))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('MidName'.$i) }}</strong>
                            </span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <span>Last name</span>
                            <div class="form-group">

                                <input type="text" @if($lastname) value="<?= $lastname ?>" disabled @else
                                       value="{{ old('lastname'.$i) }}" @endif
                                       class="form-control{{ $errors->has('lastname'.$i) ? ' is-invalid' : '' }}"
                                       name="lastname<?= $i ?>"
                                       @if($lastname) value="<?= $lastname ?>" disabled @endif>
                                @if ($errors->has('lastname'.$i))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname'.$i) }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <?php
                $i++;
                // }
            }
            ?>
        </div>
        @endif
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-body panel-body-multi">
        <div class="col-md-12">
            <div class="row">
                <span>Geregistreerde bedrijfsadres</span>
                <p class="padding-botom">Vul alstublieft hetzelfde adres in als u deze op Officiële documenten vindt.
                    Als u het land verandert, moet u een wederkeuring van het type juridische entiteit vragen. </p>

                <div class="col-md-9">

                    <div class="form-group">
                        <span>Straat <small style="color:red;">*</small></span>
                        <?php if (isset($user->street)) { ?>
                            <input type="text" class="form-control" required="" value="<?= $user->street ?>"
                                   name="streets" disabled>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('streets') ? ' is-invalid' : '' }}"
                                   value="{{ old('streets') }}" name="streets" required>
                            @if ($errors->has('streets'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('streets') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="form-group">
                        <span>Huisnummer <small style="color:red;">*</small></span>

                        <?php if (isset($user->h_b_number)) { ?>
                            <input type="text" class="form-control" name="housebuildname"
                                   value="<?= $user->h_b_number ?>" required disabled>
                        <?php } else { ?>
                            <input type="number"
                                   class="form-control{{ $errors->has('housebuildname') ? ' is-invalid' : '' }}"
                                   name="housebuildname"
                                   value="{{ old('housebuildname') }}" required>
                            @if ($errors->has('housebuildname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('housebuildname') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="col-md-5">
                    <div class="form-group">
                        <span>Postcode <small style="color:red;">*</small></span>
                        <?php if (isset($user->postcode)) { ?>
                            <input type="text" class="form-control" name="postcode" value="<?= $user->postcode ?>"
                                   disabled>
                        <?php } else { ?>
                            <input type="number" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}"
                                   name="postcode" value="{{ old('postcode') }}" required>
                            @if ($errors->has('postcode'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('postcode') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="form-group">
                        <span>Stad / plaats: <small style="color:red;">*</small></span>
                        <?php if (isset($user->city_town)) { ?>
                            <input type="text" class="form-control" name="citytown" value="<?= $user->city_town ?>"
                                   disabled required>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('citytown') ? ' is-invalid' : '' }}"
                                   name="citytown" value="{{ old('citytown') }}" required>
                            @if ($errors->has('citytown'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('citytown') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-5">
                    <div class="form-group">
                        <span>Provincie <small style="color:red;">*</small></span>
                        <?php if (isset($user->county)) { ?>
                            <input type="text" class="form-control" name="county" value="<?= $user->county ?>" disabled>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('county') ? ' is-invalid' : '' }}"
                                   name="county" value="{{ old('county') }}" required>
                            @if ($errors->has('county'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('county') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                        <input type="hidden" class="form-control" name="extention" value="0">
                    </div>
                </div>


                <div class="col-md-7">
                    <div class="form-group">
                        <span> land <small style="color:red;">*</small></span>
                        <select class="form-control" id="kycBusinessInfo_Country" name="kycBusinessInfo_Country"
                                required>
                            <option value="NL" @if($user->country ?? '') {{ ($user->country == 'NL') ? 'selected' : ''
                                }} @endif>Netherlands
                            </option>
                            <option value="BE" @if($user->country ?? '') {{ ($user->country == 'BE') ? 'selected' : ''
                                }} @endif>Belgium
                            </option>

                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="panel panel-default">
    <div class="panel-body panel-body-multi">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <span>Telefoonnummer <small style="color:red;">*</small></span>
                        <?php if (isset($user->phonenumber)) { ?>
                            <input type="text" class="form-control" name="pnumber" value="<?= $user->phonenumber ?>"
                                   disabled required>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('pnumber') ? ' is-invalid' : '' }}"
                                   name="pnumber" value="{{ old('pnumber') }}" required>
                            @if ($errors->has('pnumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pnumber') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                        <!--       <input type="hidden" class="form-control" name="user_id"  value="<?= $userId; ?>" > -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Work Phone: <small style="color:red;">*</small></span>
                        <?php if (isset($user->workphone)) { ?>
                            <input type="text" class="form-control" name="wnumber" value="<?= $user->workphone ?>"
                                   disabled required>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('wnumber') ? ' is-invalid' : '' }}"
                                   name="wnumber" value="{{ old('wnumber') }}" required>
                            @if ($errors->has('wnumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('wnumber') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Mobile number: <small style="color:red;">*</small></span>
                        <?php if (isset($user->mobilephone)) { ?>
                            <input type="text" class="form-control" name="mnumber" value="<?= $user->mobilephone ?>"
                                   disabled required>
                        <?php } else { ?>
                            <input type="text" class="form-control{{ $errors->has('mnumber') ? ' is-invalid' : '' }}"
                                   name="mnumber" value="{{ old('mnumber') }}" required>
                            @if ($errors->has('mnumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mnumber') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <span>Email admin: <small style="color:red;">*</small></span>
                        <?php if (isset($user->email_admin)) { ?>
                            <input type="text" class="form-control" name="emailadmin" value="<?= $user->email_admin ?>"
                                   required disabled>
                        <?php } else { ?>
                            <input type="email"
                                   class="form-control{{ $errors->has('emailadmin') ? ' is-invalid' : '' }}"
                                   name="emailadmin" value="{{ old('emailadmin') }}" required>
                            @if ($errors->has('emailadmin'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('emailadmin') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Email sales: <small style="color:red;">*</small></span>
                        <?php if (isset($user->email_sales)) { ?>
                            <input type="text" class="form-control" name="email_sale" value="<?= $user->email_sales ?>"
                                   required disabled>
                        <?php } else { ?>
                            <input type="email"
                                   class="form-control{{ $errors->has('email_sale') ? ' is-invalid' : '' }}"
                                   name="email_sale" value="{{ old('email_sale') }}" required>
                            @if ($errors->has('email_sale'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email_sale') }}</strong>
                            </span>
                            @endif
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Weergavenaam <small style="color:red;">*</small></span>
                        <?php if (isset($reg_business->display_name)) { ?>
                        <input type="text" class="form-control" name="dname"
                               value="<?= $reg_business->display_name ?>" required disabled>
                        <?php } else { ?>
                        <input type="text" class="form-control{{ $errors->has('dname') ? ' is-invalid' : '' }}"
                               name="dname" value="{{ old('dname') }}" required>
                        @if ($errors->has('dname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dname') }}</strong>
                            </span>
                        @endif
                        <?php } ?>
                    </div>
                </div>
            </div>
            <br>
            @if(empty($user))
                <button name="button" type="submit" class="btn btn btn-primary" id="button" value="true">Save</button>
            @else
                <button type="button" class="btn btn btn-primary" id="" value="" disabled>Save</button>
            @endif
        </div>
    </div>
</div>
</div>
</div>
</form>
<style>
    .input {
        margin-bottom: 3px;
        width: 391px;
    }
</style>
<br>
<div class="about-left sting" id="product_selection" style="display:block;">
    <div class="panel panel-default">
        <div class="panel-body panel-body-multi">
            <div class="col-md-12">
                <div class="row">
                    <h3>Verkoopplan</h3>
                    <form action="/adminSellingplanregis" method="post" accept-charset="utf-8">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" class="form-control" name="user_id" value="<?= $userId; ?>">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <input type="checkbox" name="prod" value="1" required="" checked>
                                </div>
                                <div class="col-md-10">
                                    <h4>Sell on Unikoop </h4>
                                    <span>Reach tens of millions of Unikoop customers when you sell your products on unikoop European Marketplaces. £25.00 a month (excl VAT) + Selling Fees.  </span>
                                </div>
                            </div>
                            <br>
                            <label>Bol Secrets (NL)</label>
                            <input class="form-control input" type="text" @if($userrecord->bol_client_id ?? '')
                         value="{{$userrecord->bol_client_id}}" disabled @endif name="bol_client_id" placeholder="Bol client id (NL)">
                            <input class="form-control input" type="text" @if($userrecord->bol_client_secret ?? '')
                            value="{{$userrecord->bol_client_secret}}" disabled @endif name="bol_client_secret"
                            placeholder="Bol client secret (NL)">
                            <br>
                            <label>Bol Secrets (BE)</label>
                            <input class="form-control input" type="text" @if($userrecord->bol_be_client_id ?? '')
                            value="{{$userrecord->bol_be_client_id}}" disabled @endif name="bol_be_client_id"
                            placeholder="Bol client id (BE)">
                            <input class="form-control input" @if($userrecord->bol_be_client_secret ?? '')
                            value="{{$userrecord->bol_be_client_secret}}" disabled @endif type="text"
                            name="bol_be_client_secret" placeholder="Bol client secret (BE)">
                            <hr>

                            <div class="panel-body">
                                <!--   <a class="btn btn-warning" name="Start" href="dashboard">
                                      Annuleer</span></span></a> -->

                                <button name="button" type="submit" @if($userrecord->bol_client_id ?? '') disabled
                                    @endif class="btn btn-primary" id="button" value="true" >Save
                                </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-left sting " id="logistiek" style="display:block;margin-top: 15px;">
    <div class="panel panel-default">
        <div class="panel-body panel-body-multi">
            <div class="row">
                <div class="col-md-12">
                    <h3>Unikoop Logistiek</h3>
                    <form action="/adminLogistiek" method="post" accept-charset="utf-8">
                        <br>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Credit Limit</label>
                                    <small style="color: red;"> *</small>
                                    <input class="form-control" type="text" @if($userrecord->credit_limit ?? '')
                                    value="{{$userrecord->credit_limit}}" disabled @endif name="credit_limit"
                                    placeholder="Credit Limit" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs">
                                    <li class="active" style="display: contents;">
                                        <a href="#dhl" data-toggle="tab">DHL</a>
                                    </li>
                                    <li style="display: contents;">
                                        <a href="#dpd" data-toggle="tab">DPD</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="dhl" class="tab-pane fade in active">
                                        <h3>DHL</h3>
                                        <br>
                                        <input type="hidden" name="Logistiek" value="DHL">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Price Per Label</label>
                                                    <small style="color: red;"> *</small>
                                                    <br>
                                                    @php
                                                        $label_exist = ($userrecord->price_per_label) ?? '';
                                                    @endphp
                                                    @if($label_exist)
                                                        <input class="form-control" type="text"  value="{{$userrecord->price_per_label}}" disabled name="price_limit" placeholder="Price Per Limit">
                                                    @else
                                                        @if ($dhl->is_active == 'Unikoop')
                                                            <input type="radio" name="dhl_price_label" onclick="dhlCustom('0')" value="{{ $dhl->dhl_unikoop_price }}">
                                                            Unikoop Price (&euro;{{ $dhl->dhl_unikoop_price }})
                                                        @else
                                                            <input type="radio" name="dhl_price_label" onclick="dhlCustom('0')" value="{{ $dhl->dhl_discount_price }}">
                                                            Discount Price (&euro;{{ $dhl->dhl_discount_price }})
                                                        @endif
                                                        <input type="radio" name="dhl_price_label" value="custom" onclick="dhlCustom('1')"> Custom Value
                                                            <br>
                                                            <input type="text" name="price_limit" value="0" class="form-control" style="display: none" id="dhl-custom-input" placeholder="Price Per Label">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">DHL Client Id</label>
                                                    <small style="color: red;"> *</small>
                                                    <input class="form-control" type="text" @if($settings ??'')
                                                    value="{{$settings->client_id}}" disabled @endif name="client_id"
                                                    placeholder="Client Id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">DHL Account Id</label>
                                                    <small style="color: red;"> *</small>
                                                    <input class="form-control" type="text" @if($settings ??'')
                                                    value="{{$settings->account_id}}" disabled @endif name="account_id"
                                                    placeholder="Account Id">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">DHL Key</label>
                                                    <small style="color: red;"> *</small>
                                                    <input class="form-control" type="text" @if($settings ??'')
                                                    value="{{$settings->dhlkey}}" disabled @endif name="dhlkey"
                                                    placeholder="Dhl Key">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dpd" class="tab-pane fade">
                                        <h3>DPD</h3>
                                        <br>
                                        <input type="hidden" name="dpd_logistiek" value="DPD">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Price Per Label</label>
                                                    <small style="color: red;"> *</small>
                                                    <br>
                                                    @php
                                                        $label_exist = ($userrecord->price_per_label_dpd) ?? '';
                                                    @endphp
                                                    @if($label_exist)
                                                        <input class="form-control" type="text"  value="{{$userrecord->price_per_label_dpd}}" disabled name="dpd_price_limit" placeholder="Price Per Limit">
                                                    @else
                                                        @if ($dpd->is_active == 'Unikoop')
                                                            <input type="radio" name="dpd_price_label" onclick="dpdCustom('0')" value="{{ $dpd->dpd_unikoop_price }}">
                                                            Unikoop Price (&euro;{{ $dpd->dpd_unikoop_price }})
                                                        @else
                                                            <input type="radio" name="dpd_price_label" onclick="dpdCustom('0')" value="{{ $dpd->dpd_discount_price }}">
                                                            Discount Price (&euro;{{ $dpd->dpd_discount_price }})
                                                        @endif
                                                        <input type="radio" name="dpd_price_label" value="custom" onclick="dpdCustom('1')"> Custom Value
                                                        <br>
                                                        <input type="text" name="dpd_price_limit" value="0" class="form-control" style="display: none" id="dpd-custom-input" placeholder="Price Per Label">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">DPD Delisid</label>
                                                    <small style="color: red;"> *</small>
                                                    <input class="form-control" type="text" @if($settings ??'') value="{{$settings->dpd_delisid}}" disabled @endif name="dpd_delisid" placeholder="API DelisId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">DPD Username</label>
                                                    <small style="color: red;"> *</small>
                                                    <input class="form-control" type="text" @if($settings ??'') value="{{$settings->dpd_username}}" disabled @endif name="dpd_username" placeholder="API Username">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">DPD Password</label>
                                                    <small style="color: red;"> *</small>
                                                    <input class="form-control" type="text" @if($settings ??'') value="{{$settings->dpd_password}}" disabled @endif name="dpd_password" placeholder="API Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if($userrecord->credit_limit ?? '')
                                    <button name="" type="button" class="btn btn btn-primary" id="button" value=""
                                            disabled>
                                        Save
                                    </button>
                                    @else
                                    <button name="button" type="submit" class="btn btn btn-primary" id="button"
                                            value="true">Save
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
   function myFunction() {
   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            var email = $("#email").val();
            var pass = $("#pass").val();
            if(pass.length != '8'){
                alert('password must be atleast 8 characters.');
            }
else{
             $.ajax({
                    type: "post",
                    url: "{{url('/storee')}}",
                    data: { "_token": "{{ csrf_token() }}", "email": email,"password":pass },
                    dataType: "json",
                     success: function (data) {
                        $("#email").val(data.email);
                        alert('user created successfully');
                        location.reload();
                        $("#second_card").css("display","block");
       },
      error: function(data, errorThrown)
          {
              alert('request failed :'+errorThrown);
       }
    });
         }
    }
</script> -->
<script>
    function dhlCustom(p)
    {
        if (p == '1')
            document.getElementById('dhl-custom-input').style.display = 'block';
        else
            document.getElementById('dhl-custom-input').style.display = 'none';
    }

    function dpdCustom(p)
    {
        if (p == '1')
            document.getElementById('dpd-custom-input').style.display = 'block';
        else
            document.getElementById('dpd-custom-input').style.display = 'none';
    }
</script>
<script language="javascript">

    function billing00000() {

        var chrge = '';

        if (chrge == 'bank transfer') {
            document.getElementById('option2').style.display = "block";
            document.getElementById('option1').style.display = "none";
            document.getElementById('option3').style.display = "none";

        } else if (chrge == 'Credit card') {
            document.getElementById('option3').style.display = "none";
            document.getElementById('option2').style.display = "none";
            document.getElementById('option1').style.display = "block";
        } else if (chrge == 'ideal payment') {

            document.getElementById('option2').style.display = "none";
            document.getElementById('option1').style.display = "none";
            document.getElementById('option3').style.display = "block";
        }
    }
</script>
<script language="javascript">

    function acc_info() {

        var business_owner = '';
        var propritership = <?=$subentity ?? ''?>;

        var entity =<?=$entity ?? ''?>;

        if (business_owner == 1) {

            document.getElementById('enityies').style.display = "block";
            document.getElementById('box').style.display = "none";
            document.getElementById('box2').style.display = "none";
        } else if (business_owner == 0) {

            document.getElementById('enityies').style.display = "none";
            document.getElementById('box').style.display = "block";
        }
        if (propritership == 1) {
            document.getElementById('enityies').style.display = "block";
        }

        if (entity == 5) {
            document.getElementById('individual').style.display = "block";
            document.getElementById('comp_detail').style.display = "none";
        } else {

            document.getElementById('sub_entity' + entity).style.display = "block";
            document.getElementById('comp_detail').style.display = "block";
            document.getElementById('individual').style.display = "none";

        }
    }

</script>
<script type="text/javascript">
    function showonlyone(thechosenone) {

        $('.sting').each(function (index) {

            if ($(this).attr("id") == thechosenone) {
                $(this).show(200);


                if (thechosenone == 'billing') {
                    billing00000();
                } else if (thechosenone == 'businessandcontact') {
                    acc_info();
                }
            } else {
                $(this).hide(200);
            }
        });
    }
</script>

 <script>
        $(function() {

            if ($("#show").is(":checked")) {
                $('#enityies').css('display','block');
                if ($("#enitys").is(":checked")) {
                    var value = $("#enitys").val();

                    switch (value)
                    {
                        case '1':
                            $('#sub_entity1').css('display','block');
                            break;
                        case '2':
                            $('#sub_entity2').css('display','block');
                            break;
                        case '3':
                            $('#sub_entity3').css('display','block');
                            break;
                    }
                    $('#comp_detail').css('display','block');

                }

            }
            if ($("#hides").is(":checked")) {
                $('#box').css('display','block');

                if ($("#hid").is(":checked")) {
                    $('#box2').css('display','block');
                }
            }

                if ($("#three").is(":checked")) {
                $('#option3').css('display','block');
   }
                if ($("#two").is(":checked")) {
                    $('#option2').css('display','block');
                }
                if ($("#one").is(":checked")) {
                    $('#option1').css('display','block');
                }
         
        });

    </script>

@endsection