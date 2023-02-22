{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
@section('title','Reset Password | Unikoop')

@include('auth/header')


<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">


                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="{{ route('home') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_logo) : '' }}" alt="" height="22">
                                        </span>
                                    </a>

                                    <!-- <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </a> -->
                                </div>
                                <p class="text-muted mb-2 mt-2">Reset Your Password </p>
                            </div>

                            {{-- <x-jet-validation-errors class="mb-4" /> --}}


                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">





                                <div class="row mb-2">

                                    <div class="mb-1">
                                        <x-jet-label for="email" value="{{ __('Email') }}" class="form-label" />
                                        <x-jet-input class="form-control" id="email" type="email" name="email"
                                            :value="old('email', $request->email)" placeholder="Enter your Email" required />
                                    </div>
                                    @foreach ($errors->get('email') as $message)
                                        <span style="color: red">{{ $message }}</span>
                                    @endforeach

                                </div>

                                <div class="row mb-2">

                                    <div class="mb-1">
                                        <x-jet-label for="password" class="form-label"
                                            value="{{ __('Create New Password') }}" />
                                        <div class="input-group input-group-merge">
                                            <x-jet-input type="password" name="password" id="password"
                                                class="form-control" placeholder="Enter your password"
                                                autocomplete="new-password" />
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        @foreach ($errors->get('password') as $message)
                                            <span style="color: red">{{ $message }}</span>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="row mb-2">

                                    <div class="mb-1">
                                        <x-jet-label for="password_confirmation" class="form-label"
                                            value="{{ __('Confirm Password') }}" />
                                        <div class="input-group input-group-merge">
                                            <x-jet-input type="password" id="password_confirmation"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Enter your password" required
                                                autocomplete="new-password" />
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        @foreach ($errors->get('password_confirmation') as $message)
                                            <span style="color: red">{{ $message }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-center d-grid mt-3">
                                    <button class="btn btn-lg btn-primary" type="submit">
                                        {{ __('Reset Password') }}</button>
                                    <!-- <button onclick="document.location='default.asp'">HTML Tutorial<a href="dashboard.html"></a> </button> -->
                                </div>

                            </form>



                        </div> <!-- end card-body -->
                    </div>


                    <!-- end card -->


                </div>


            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->



    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <script type="text/javascript">
        function cap() {
            var alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
                'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e',
                'f', 'g', 'h', 'i',
                'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '@', '#', '$',
                '%', '^', '&', '*', '+'
            ];
            var a = alpha[Math.floor(Math.random() * 71)];
            var b = alpha[Math.floor(Math.random() * 71)];
            var c = alpha[Math.floor(Math.random() * 71)];
            var d = alpha[Math.floor(Math.random() * 71)];
            var e = alpha[Math.floor(Math.random() * 71)];
            var f = alpha[Math.floor(Math.random() * 71)];

            var final = a + b + c + d + e + f;
            document.getElementById("capt").value = final;
        }

        function validcap() {
            var stg1 = document.getElementById('capt').value;
            var stg2 = document.getElementById('textinput').value;
            if (stg1 == stg2) {
                alert("Form is validated Succesfully");
                return true;
            } else {
                alert("Please enter a valid captcha");
                return false;
            }
        }
    </script>

</body>

</html>
