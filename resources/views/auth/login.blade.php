
{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>


    </x-jet-authentication-card>
</x-guest-layout> --}}
@section('title','Login | Unikoop')

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
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-dark.png" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                                </div>



                                {{-- <x-jet-validation-errors class="mb-4" /> --}}

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
                                    {{-- <label>Enter Captcha:</label>
                                    <div class="row">
                                  <div class="form col-md-6">
                                      <input type="text" class="form-control" readonly id="capt">
                                        </div>
                                <div class="form col-md-6">
                                      <input type="text" class="form-control" id="textinput" required="">
                                             </div>
                                        </div>
                                     <h6>Captcha not visible <img src="refresh.jpg" width="40px" onclick="cap()"></h6> --}}

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
                                <div class="col-6 text-center d-grid mt-1">
                                    <a href="{{ route('register') }}" class ="btn btn-lg btn-outline-success" type="submit">  {{ __('Get Invoice') }} </a>
                                    <!-- <button onclick="document.location='default.asp'">HTML Tutorial<a href="dashboard.html"></a> </button> -->
                                 </div>
                                 <div class="col-6 text-center d-grid mt-1">
                                    <a href="{{ route('track.order') }}" class ="btn btn-lg btn-outline-info" type="submit">  {{ __('Track Order') }} </a>
                                    <!-- <button onclick="document.location='default.asp'">HTML Tutorial<a href="dashboard.html"></a> </button> -->
                                 </div>
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
                <div class="carousel mt-4" data-flickity='{ "wrapAround": true, "autoPlay": true, "imagesLoaded":true }'>
                    <div class="carousel-cell">
                      <img class="w3-image" src="https://smash-images.photobox.com/original/5f04c1b41fd48d1b10ff27dfc90548bf13608845_Large-Print-lifestyle-3_1-2600.jpg">
                    </div>
                    <div class="carousel-cell">
                      <img class="w3-image" src="https://smash-images.photobox.com/original/bca8e5fa7862a2cfaefc300c5b572e7a6dc6f3f3_Standard-Prints-lifestyle-3_1-2600.jpg">
                    </div>
                    <div class="carousel-cell">
                      <img class="w3-image" src="https://smash-images.photobox.com/original/a422aed1a721e933961b19ea9e47e07fc71e0699_Acrylic-Prints-lifestyle-3_1-2600.jpg">
                    </div>
                    <div class="carousel-cell">
                     <img class="w3-image" src="https://smash-images.photobox.com/original/5f04c1b41fd48d1b10ff27dfc90548bf13608845_Large-Print-lifestyle-3_1-2600.jpg">
                    </div>
                    <div class="carousel-cell">
                      <img class="w3-image" src="https://smash-images.photobox.com/original/bca8e5fa7862a2cfaefc300c5b572e7a6dc6f3f3_Standard-Prints-lifestyle-3_1-2600.jpg">
                    </div>
                    <div class="carousel-cell">
                      <img class="w3-image" src="https://smash-images.photobox.com/original/a422aed1a721e933961b19ea9e47e07fc71e0699_Acrylic-Prints-lifestyle-3_1-2600.jpg">
                    </div>
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
        <script type="text/javascript">
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

    </body>
</html>
