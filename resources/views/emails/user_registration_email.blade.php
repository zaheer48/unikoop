<html>
<head>
    <link rel="stylesheet" href="{{ asset('dhl/css/bootstrap.min.css') }}">
    <link href="{{ asset('dhl/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dhl/font-awesome/css/font-awesome.min.css') }}">
</head>
<body>
@if($type == 'user_approval_by_admin')
    <div class="row" style="padding: 20px;">
        <h3><strong>{{ $username }} </strong> make a new registration Please check it to make it Approve or update user Data.</h3>
        <div class="col-md-6">
            <p>
                 Username: <strong>{{ $username }}</strong>
            </p>
            <p>
                 User Email: <strong>{{ $email }}</strong>
            </p>
        </div>
        <p>Best Regards,</p>
    </div>
@endif
@if($type == 'admin_approval_user')
    <div class="row" style="padding: 20px;">
        <h3>Hi &nbsp;<strong>{{ $username }} </strong>!</h3>
            <p><strong><mark>Congratulations</mark></strong>  Your account is approved by admin. Now you can login to Unikoop dashboard to continue your services.</p>
        <p>Your Record is as follow: </p>
        <div class="col-md-6">
            <p>
                 Username: <strong>{{ $username }}</strong>
            </p>
            <p>
                 Email: <strong>{{ $email }}</strong>
            </p>
            <p>
                 Password: <strong>{{ $password }}</strong>
            </p>
        </div>
        <p>Best Regards,</p>
    </div>
@endif
</body>
</html>