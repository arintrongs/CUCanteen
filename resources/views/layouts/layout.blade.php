<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rate my Canteen</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
        <!-- CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL :: asset('css/app.css')}}">
          
    </head>
    <body>
        <!-- NAV -->
        <nav class="navbar navbar-light fixed-top" >
            <div class="col-lg-2">
                <a class="brand float-right" href="#">Rate My Canteen.</a>
            </div>
            <div class="col-lg-7">
                <input class="form-control form-control-lg mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
            <div class="col-lg-3">
                <a>Location : </a>
            </div>
        </nav>
        <!-- Header -->
        <div class="container-fluid header">

        </div>
        <!-- Content -->
        <div class="container pad-top">
            <div class="row">
            <div class="col-lg-4">
                @yield('content_1')
            </div>
            <div class="col-lg-4">
                @yield('content_2')
            </div>
            <div class="col-lg-4">
                @yield('content_3')
            </div>
            </div>
        </div>
        <!-- Script -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>    
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        @yield('footer')
    </body>
</html>
