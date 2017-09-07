<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Rate my Canteen</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
        <!-- CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL :: asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL :: asset('fonts/font-awesome.min.css')}}">
          
    </head>
    <body>
        <!-- NAV -->
        <nav class="navbar navbar-light fixed-top" >
            <div class="col-lg-3 col-xl-3">
                <div class="brand float-right" href="#">Rate My Canteen.</div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <input class="form-control form-control-lg mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
            <div class="col-lg-3 col-xl-3">
                <div class="login">
                    <a href="#" data-toggle="modal" data-target="#login-modal">
                        <i class="fa fa-user icon" aria-hidden="true"></i>
                    </a>
               
                </div>
            </div>
        </nav>

        <!-- Header -->
        <div class="container-fluid header pad-bot">

        </div>

        <!-- Login Modal -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
                <div class="loginmodal-container">
                    <h1>Login to Your Account</h1><br>
                  <form method="post" onsubmit="return false;">
                    <input type="text" name="user" placeholder="Username">
                    <input type="password" name="pass" placeholder="Password">
                    <input type="submit" name="login" class="login loginmodal-submit" value="Login" onclick="return doLogin();">
                  </form>
                    
                  <div class="login-help">
                    <a href="#">Register</a> - <a href="#">Forgot Password</a>
                  </div>
                </div>
            </div>
          </div>

        <!-- Store's Content -->
        <div class="container-fluid store-content" style="display: none;">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-7" >
                    <div class="container-fluid store">
                        @yield('store')
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="container-fluid rating"><!-- 
                        <h2>Rating</h2>
                        <h2><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></h2>
                        <h3>5.00</h3> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment -->
        <div class="row comment-content" style="display: none;">
            <div class="col-lg-3"></div>
            <div class="col-lg-5">                
                @yield('comment')
                @yield('others')
            </div>
            <!-- <div class="col-lg-4"></div> -->
        </div>

        <!-- Card's Content -->
        <div class="container card-content">
            <div class="row">
                    @yield('content')
            </div>
        </div>
        <!-- Script -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="http://momentjs.com/downloads/moment.js"></script>
        <script src="{{ URL :: asset('js/canteen/canteen.js') }}"></script>
        <script src="{{ URL :: asset('js/canteen/autocomplete.js') }}"></script>
        <script src="{{ URL :: asset('js/canteen/shop.js') }}"></script>
        <script src="{{ URL :: asset('js/user.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
        @yield('footer')
    </body>
</html>
