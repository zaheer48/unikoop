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
                                    <img src="assets/images/users/user-1.jpg" height="88" alt="user-image" class="rounded-circle shadow">
                                    <h4 class="text-dark-50 text-center mt-3">Hi ! Geneva </h4>
                                    <p class="text-muted mb-4">Enter your password to access the admin.</p>
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


                                        <div class="text-center d-grid mt-1">
                                         <button  class ="btn btn-lg btn-primary" type="submit">  {{ __('Log in') }} </button>
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
