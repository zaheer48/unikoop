<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('dhl/css/bootstrap.min.css') }}">
    <link href="{{ asset('dhl/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dhl/font-awesome/css/font-awesome.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700'
          rel='stylesheet' type='text/css'>
</head>
<body>
@if($type == 'bussiness_toadmin')
<div class="row" style="padding: 20px;">
    <h3><strong>{{ $username }}</strong> Want to change thier Bussiness info, Please check it.</h3>
    <div class="col-md-6">
        <p>
            Username: <strong>{{ $username }}</strong>
        </p>
        <p>
            Straat: <strong>{{ $street }}</strong>
        </p>
        <p>
            Postcode: <strong>{{ $postcode }}</strong>
        </p>
        <p>
            Provincie: <strong>{{ $county }}</strong>
        </p>
        <p>
            Telefoonnummer: <strong>{{ $pnumber }}</strong>
        </p>
        <p>
            Mobile number: <strong>{{ $mnumber }}</strong>
        </p>
        <p>
            Email sales: <strong>{{ $email_sale }}</strong>
        </p>
    </div>
    <div class="col-md-6">
        <p>
            Huisnummer: <strong>{{ $housebuildname }}</strong>
        </p>
        <p>
            Stad / plaats: <strong>{{ $citytown }}</strong>
        </p>
        <p>
            Land: <strong>{{ $kycBusinessInfo_Country }}</strong>
        </p>
        <p>
            Work Phone: <strong>{{ $wnumber }}</strong>
        </p>
        <p>
            Email admin: <strong>{{ $emailadmin }}</strong>
        </p>
    </div>
</div>
<p>Best Regards,</p>
@endif
@if($type == 'admin_approval_bussiness')
    <div class="row" style="padding: 20px;">
        <h3>Hello <strong>{{ $username }}!</strong></h3>
        <p><strong>Congratulations!!!! </strong>Your This Bussiness Info is approved by admin</p>
        <div class="col-md-6">
            <p>
                Straat: <strong>{{ $street }}</strong>
            </p>
            <p>
                Postcode: <strong>{{ $postcode }}</strong>
            </p>
            <p>
                Provincie: <strong>{{ $county }}</strong>
            </p>
            <p>
                Telefoonnummer: <strong>{{ $pnumber }}</strong>
            </p>
            <p>
                Mobile number: <strong>{{ $mnumber }}</strong>
            </p>
            <p>
                Email sales: <strong>{{ $email_sale }}</strong>
            </p>
        </div>
        <div class="col-md-6">
            <p>
                Huisnummer: <strong>{{ $housebuildname }}</strong>
            </p>
            <p>
                Stad / plaats: <strong>{{ $citytown }}</strong>
            </p>
            <p>
                Land: <strong>{{ $kycBusinessInfo_Country }}</strong>
            </p>
            <p>
                Work Phone: <strong>{{ $wnumber }}</strong>
            </p>
            <p>
                Email admin: <strong>{{ $emailadmin }}</strong>
            </p>
        </div>
    </div>
    <p>Best Regards,</p>
@endif

@if($type == 'admin_reject_bussiness')
    <div class="row" style="padding: 20px;">
        <h3>Hello <strong>{{ $username }}!</strong></h3>
        <p><strong>OOOOPS!!!! </strong>Your This Bussiness Info is Rejected by admin</p>
        <div class="col-md-6">
            <p>
                Straat: <strong>{{ $street }}</strong>
            </p>
            <p>
                Postcode: <strong>{{ $postcode }}</strong>
            </p>
            <p>
                Provincie: <strong>{{ $county }}</strong>
            </p>
            <p>
                Telefoonnummer: <strong>{{ $pnumber }}</strong>
            </p>
            <p>
                Mobile number: <strong>{{ $mnumber }}</strong>
            </p>
            <p>
                Email sales: <strong>{{ $email_sale }}</strong>
            </p>
        </div>
        <div class="col-md-6">
            <p>
                Huisnummer: <strong>{{ $housebuildname }}</strong>
            </p>
            <p>
                Stad / plaats: <strong>{{ $citytown }}</strong>
            </p>
            <p>
                Land: <strong>{{ $kycBusinessInfo_Country }}</strong>
            </p>
            <p>
                Work Phone: <strong>{{ $wnumber }}</strong>
            </p>
            <p>
                Email admin: <strong>{{ $emailadmin }}</strong>
            </p>
        </div>
    </div>
    <p>Best Regards,</p>
@endif

@if($type == 'wallet_toadmin')
    <div class="row" style="padding: 20px;">
        <h3><strong>{{ $username }}</strong> Want to Recharge thier Wallet, Please check it.</h3>
        <div class="col-md-6">
            <p>
                Amount: <strong>{{ $amount }}</strong>
            </p>
            <p>
                Description: <strong>{{ $description }}</strong>
            </p>
        </div>
    </div>
    <p>Best Regards,</p>
@endif


@if($type == 'admin_reject_wallet')
    <div class="row" style="padding: 20px;">
        <h3>Hello <strong>{{ $username }}!</strong></h3>
        <p><strong>OOOOPS!!!! </strong>Your Wallet Recharge Request is Rejected by admin.</p>
        <p>Your transection details is present in Attach PDF file</p>
    </div>
    <p>Best Regards,</p>
@endif

@if($type == 'admin_approval_wallet')
    <div class="row" style="padding: 20px;">
        <h3>Hello <strong>{{ $username }}!</strong></h3>
        <p><strong>Congratulations!!!! </strong>Your Wallet Recharge Request is Approved by admin.</p>
        <p>Your transection details is present in Attach PDF file</p>
    </div>
    <p>Best Regards,</p>
@endif

@if($type == 'profile_toadmin')
    <div class="row" style="padding: 20px;">
        <h3><strong>{{ $username }}</strong> Want to change thier profile info, Please check it.</h3>
        <div class="col-md-6">
            <p>
                username: <strong>{{ $username }}</strong>
            </p>
            <p>
                email: <strong>{{ $email }}</strong>
            </p>
        </div>
    </div>
    <p>Best Regards,</p>
@endif
@if($type == 'admin_approval_profile')
    <div class="row" style="padding: 20px;">
        <h3>Hello <strong>{{ $username }}!</strong></h3>
        <p><strong>Congratulations!!!! </strong>Your profile change Request is Approved by admin.</p>
        <p>your new data is as follow:</p>
        <p>
            username: <strong>{{ $new_username }}</strong>
        </p>
        <p>
            email: <strong>{{ $new_email }}</strong>
        </p>
    </div>
    <p>Best Regards,</p>
@endif
@if($type == 'admin_reject_profile')
    <div class="row" style="padding: 20px;">
        <h3>Hello <strong>{{ $username }}!</strong></h3>
        <p><strong>OOOOPS!!!! </strong>Your profile change Request is Rejected by admin.</p>
        <p>This was your profile data.</p>
        <p>
            username: <strong>{{ $new_username }}</strong>
        </p>
        <p>
            email: <strong>{{ $new_email }}</strong>
        </p>
    </div>
    <p>Best Regards,</p>
@endif
</body>
</html>