{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
@section('title','Forgot Password | Unikoop')

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
                                    <p class="text-muted mb-4 mt-3">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                </div>



                                {{-- <x-jet-validation-errors class="mb-4" /> --}}


                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                {{-- <x-jet-validation-errors class="mb-4" /> --}}

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <x-jet-label for="email" class="form-label" value="{{ __('Email') }}" />
                                        <x-jet-input class="form-control" name="email" type="email" id="email" :value="old('email')" required autofocus  placeholder="Enter your email" />

                                        @foreach ($errors->get('email') as $message)

                                        <span style="color: red">{{ $message}}</span>

                                        @endforeach
                                    </div>

                                        <div class="text-center d-grid mt-1">
                                         <button  class ="btn btn-lg btn-primary" type="submit">   {{ __('Email Password Reset Link') }}</button>
                                         <!-- <button onclick="document.location='default.asp'">HTML Tutorial<a href="dashboard.html"></a> </button> -->
                                              </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>

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
