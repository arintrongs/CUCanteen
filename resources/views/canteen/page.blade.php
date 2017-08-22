<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>CU Canteen</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="css/my_bootstrap.min.css" rel="stylesheet" type="text/css">
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
    <!-- Navbar -->
    @if (Config::get('auth.hasLogin'))
        @if (Auth::check())
        <nav class="navbar transparent navbar-inverse navbar-fixed-top">
            <a class="navbar-brand login-icon">
                <img src="img/user.svg" width="40" height="40" class="d-inline-block" alt="">
                Hi! User
            </a>
        </nav>
        @else
        <nav class="navbar transparent navbar-inverse navbar-fixed-top">
            <a class="navbar-brand login-icon">
                <button type="button" class="btn btn-outline-primary login-btn float-right" data-toggle="modal" data-target = "#myModal" >Login</button>
            </a>
        </nav>
        @endif
    @endif
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login to Your Account.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>
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
                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
            <script type="text/javascript">
                var stores_recomment = {!!$data['recomment'] !!};
                var stores_name = function(request, response) {
                    response({!!$data['name'] !!});
                };
            </script>
            <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
            <!-- autocomplete -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="js/canteen.js"></script>
    </body>
</html>
