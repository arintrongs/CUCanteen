<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>CU Canteen</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom CSS -->
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
-->
    <!-- Body -->
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8">
                    <center>
                        <h1 class="header">CU Canteen</h1>
                    </center>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8">
                    <div class="input-group input-group-lg">
                        <input type="search" class="form-control main-search" placeholder="Search">
                    </div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
            <div class="row">
                <br>
                <br>
            </div>
            <div class="row pad-bottom">
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8" id="store">
                    <div class="card-deck pad-bottom">
                        <div class="card">
                            <img class="card-img-top img-fluid hidden-xs-down" src="img/header.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">I-Canteen</h4>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top img-fluid" src="img/header.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">I-Canteen</h4>
                            </div>
                        </div>
                        <div class="card ">
                            <img class="card-img-top img-fluid" src="img/header.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">โรงอาหารอักษร</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
            <!-- autocomplete -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="js/canteen.js"></script>
    </body>
</html>
