{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
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

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@section('title','Register | Unikoop')

@include('auth/header')

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6">


                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="index.html" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="assets/images/logo-dark.png" alt="" height="22">
                                        </span>
                                    </a>

                                    <!-- <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </a> -->
                                </div>
                                <p class="text-muted mb-2 mt-2">Don't have an account?</p>
                            </div>

                            {{-- <x-jet-validation-errors class="mb-4" /> --}}

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                {{-- <div>
                                    <x-jet-label for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                        required autofocus autocomplete="name" />
                                </div> --}}


                                <div class="row mb-2">
                                    <div class="mb-1">
                                        <x-jet-label for="name" class="form-label" value="{{ __('Name') }}" />
                                        <x-jet-input type="text"   name="name" :value="old('name')" id="name" class="form-control"
                                            id="textinput" placeholder="First Name" autofocus autocomplete="name"  required/>
                                    </div>
                                    @foreach ($errors->get('name') as $message)

                                    <span style="color: red">{{ $message}}</span>

                                    @endforeach

                                    {{-- <div class="form col-md-6">
                                        <label for="fullname" class="form-label">Second Name</label>
                                        <input type="text" class="form-control"
                                            id="textinput"placeholder="Second Name" required>
                                    </div> --}}
                                </div>

                                <!-- <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required>
                                    </div> -->

                                {{-- <div class="mb-1">
                                    <label for="" class="form-label">Phone Number</label>
                                    <input class="form-control" type="text" id="fullname"
                                        placeholder="Enter Phone Number" required>
                                </div> --}}

                                <div class="row mb-2">

                                <div class="mb-1">
                                    <x-jet-label for="email" value="{{ __('Email') }}" class="form-label" />
                                    <x-jet-input class="form-control"  id="email" type="email"  name="email" :value="old('email')"
                                        placeholder="Enter your Email" required />
                                </div>
                                @foreach ($errors->get('email') as $message)

                                <span style="color: red">{{ $message}}</span>

                                @endforeach

                            </div>
                            <div class="row mb-2">
                                <div class="mb-1">
                                    {{-- <x-jet-label for="email" value="{{ __('Email') }}" class="form-label" /> --}}
                                    <x-jet-label for="phone"  value="{{ __('Phone Number') }}" class="form-label" />
                                    <x-jet-input class="form-control" type="text" id="phone" name="phone"
                                        placeholder="Enter Phone Number" required/>
                                </div>
                                @foreach ($errors->get('phone') as $message)

                                <span style="color: red">{{ $message}}</span>

                                @endforeach
                            </div>
                            <div class="row mb-2">
                                <div class="mb-1">
                                    <x-jet-label for="pobox_number" value="{{ __('PO BOX Number') }}" class="form-label" />
                                    <x-jet-input class="form-control" type="text" id="pobox_number" name="pobox_number"
                                        placeholder="Enter PO BOX number" required/>
                                </div>
                                @foreach ($errors->get('pobox_number') as $message)

                                <span style="color: red">{{ $message}}</span>

                                @endforeach
                            </div>
                            <div class="row mb-2">
                                <div class="mb-1">
                                    <x-jet-label for="address" value="{{ __('Address') }}" class="form-label" />
                                    <x-jet-input class="form-control" type="text" id="address" name="address"
                                        placeholder="Enter Your Address" required/>
                                </div>
                                @foreach ($errors->get('address') as $message)

                                <span style="color: red">{{ $message}}</span>

                                @endforeach
                           </div>
                            <div class="row mb-2">

                                <div class="mb-1">
                                    <x-jet-label for="password" class="form-label" value="{{ __('Password') }}" />
                                    <div class="input-group input-group-merge">
                                        <x-jet-input type="password" name="password" id="password" class="form-control"
                                            placeholder="Enter your password" autocomplete="new-password" />
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    @foreach ($errors->get('password') as $message)

                                    <span style="color: red">{{ $message}}</span>

                                    @endforeach

                                </div>
                            </div>

                            <div class="row mb-2">

                                <div class="mb-1">
                                    <x-jet-label for="password_confirmation" class="form-label" value="{{ __('Confirm Password') }}" />
                                    <div class="input-group input-group-merge">
                                        <x-jet-input type="password" id="password_confirmation" name="password_confirmation"  class="form-control"
                                            placeholder="Enter your password"  required autocomplete="new-password" />
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    @foreach ($errors->get('password_confirmation') as $message)

                                    <span style="color: red">{{ $message}}</span>

                                    @endforeach
                                </div>
                            </div>

                                {{-- <label>Enter Captcha:</label>
                                <div class="row">
                                    <div class="form col-md-6">
                                        <input type="text" class="form-control" readonly id="capt">
                                    </div>
                                    <div class="form col-md-6">
                                        <input type="text" class="form-control" id="textinput">
                                    </div>
                                </div>
                                <h6>Captcha not visible <img src="refresh.jpg" width="40px" onclick="cap()"></h6>
                                <div class="mb-2">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                        <label class="form-check-label" for="checkbox-signup">I accept <a
                                                href="javascript: void(0);" class="text-dark">Terms and
                                                Conditions</a></label>
                                    </div>
                                </div> --}}


                                <div class="text-center d-grid mt-3">
                                    <button class="btn btn-lg btn-primary" type="submit">  {{ __('Register') }} </button>
                                    <!-- <button onclick="document.location='default.asp'">HTML Tutorial<a href="dashboard.html"></a> </button> -->
                                </div>



                                <div class="flex items-center justify-end mt-4 text-center">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered ?') }}
                                    </a>


                                </div>




                                <!-- <div class="text-center d-grid">
                                        <button onclick="validcap()"class="btn btn-success" type="submit"> Sign Up </button>
                                    </div> -->

                            </form>

                            <!-- <div class="text-center">
                                    <h5 class="mt-2 text-muted">Sign up using</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                        </li>
                                    </ul>
                                </div> -->

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

    <!-- <footer class="footer footer-alt">
            2015 - <script>
                document.write(new Date().getFullYear())
            </script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a>
        </footer> -->

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