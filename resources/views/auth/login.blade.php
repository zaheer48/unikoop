@section('title','Login | Unikoop')
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
                                        <a href="{{ route('home') }}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_logo) : '' }}" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                                </div>
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <x-jet-label for="email" class="form-label" value="{{ __('Email') }}" />
                                        <x-jet-input class="form-control" name="email" type="email" id="email" :value="old('email')" required autofocus  placeholder="Enter your email" />

                                        @foreach ($errors->get('email') as $message)

                                        <span style="color: red">{{ $message}}</span>

                                        @endforeach
                                    </div>
                                    <div class="mb-3">
                                        <x-jet-label for="password" class="form-label"  value="{{ __('Password') }}" />
                                        <div class="input-group input-group-merge">
                                            <x-jet-input type="password" id="password"  name="password" class="form-control"  required autocomplete="current-password"  placeholder="Enter your password"/>
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            @foreach ($errors->get('password') as $message)

                                            <span style="color: red">{{ $message}}</span>

                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>ReCaptcha:</strong>
                                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                @endif
                                            </div>  
                                        </div>
                                    </div>
                                    {{-- <label>Enter Captcha:</label>
                                    <div class="row">
                                        <div class="form col-md-6">
                                            <input type="text" class="form-control" readonly id="capt">
                                        </div>
                                        <div class="form col-md-6">
                                            <input type="text" class="form-control" id="textinput" required="">
                                        </div>
                                    </div>
                                    <h6>Captcha not visible <img src="{{asset('assets/libs/feather-icons/icons/refresh-cw.svg')}}" onclick="cap()"></h6> --}}

                                    {{-- <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label " for="checkbox-signin">Remember me</label>
                                    </div> --}}
                                    <div class="block mt-4">
                                        <label for="remember_me" class="flex items-center">
                                            <x-jet-checkbox id="remember_me" name="remember" class="form-check-input" id="checkbox-signin" checked />
                                            <span class="ml-2 underline text-sm text-gray-600 hover:text-gray-900">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-end mt-3">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="text-center d-grid mt-1">
                                        <button  class ="btn btn-lg btn-outline-primary" type="submit">  {{ __('Log in') }} </button>
                                        <!-- <button onclick="document.location='default.asp'">HTML Tutorial<a href="dashboard.html"></a> </button> -->
                                    </div>
                                    <div class="flex items-center justify-end mt-3">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="register">
                                            {{ __('Do not have an account ? SignUp') }}
                                        </a>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div> -->
                                </form>
                                <div class="row mt-3">                                    
                                    @if(isset($modules['GenerateInvoice']) ? $modules['GenerateInvoice']->isEnabled() : 0)
                                    <div class="col-6 text-center d-grid mt-1">
                                        <a href="{{ route('get.invoice') }}" class ="btn btn-lg btn-outline-success" type="submit">  {{ __('Get Invoice') }} </a>
                                    </div>
                                    @endif
                                    @if(isset($modules['TrackOrder']) ? $modules['TrackOrder']->isEnabled() : 0)
                                    <div class="col-6 text-center d-grid mt-1">
                                        <a href="{{ route('track.order') }}" class ="btn btn-lg btn-outline-info" type="submit">  {{ __('Track Order') }} </a>
                                    </div>
                                    @endif
                                </div>
                                <!-- <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign in with</h5>
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
                                   <!--
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="auth-recoverpw.html" class="text-white-50 ms-1">Forgot your password?</a></p>
                                <p class="text-white-50">Don't have an account? <a href="auth-register.html" class="text-white ms-1"><b>Sign Up</b></a></p>
                            </div> end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                
                @php
                $settings = \DB::table('website_settings')->first();
            @endphp
                <div class="carousel mt-4" data-flickity='{ "wrapAround": true, "autoPlay": true, "imagesLoaded":true }'>
                    @if($settings->partners_logo != null)
                    @php
                        $files = explode(",",$settings->partners_logo);
                    @endphp
                    @foreach($files as $files => $value)
                    <div class="carousel-cell">
                        <img class="w3-image" src="{{ asset('portal/'.$value) }}">
                      </div>
                    @endforeach
                @endif
                </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        {{-- <script type="text/javascript">
            function cap(){
              var alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'
                           ,'W','X','Y','Z','1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i',
                           'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '!','@','#','$','%','^','&','*','+'];
                           var a = alpha[Math.floor(Math.random()*71)];
                           var b = alpha[Math.floor(Math.random()*71)];
                           var c = alpha[Math.floor(Math.random()*71)];
                           var d = alpha[Math.floor(Math.random()*71)];
                           var e = alpha[Math.floor(Math.random()*71)];
                           var f = alpha[Math.floor(Math.random()*71)];
                           var final = a+b+c+d+e+f;
                           console.log(final);
                           document.getElementById("capt").value=final;
                         }
                         function validcap(){
                          var stg1 = document.getElementById('capt').value;
                          var stg2 = document.getElementById('textinput').value;
                          if(stg1==stg2){
                            alert("Form is validated Succesfully");
                            return true;
                          }else{
                            alert("Please enter a valid captcha");
                            return false;
                          }
                         }
          </script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6LcnHv4ZAAAAAB8bFzbAfR9zBDSkNfYFMgLZ7J_g', {action: 'homepage'}).then(function(token) {
                    console.log(token);
                });
            });
            function recaptchaCallback() {
                $('#button').removeAttr('disabled');
                $('#register_button').removeAttr('disabled');
            };
        </script> --}}
    </body>
</html>
