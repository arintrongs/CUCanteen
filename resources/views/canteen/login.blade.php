@extends('canteen.layout')

@section('body')

<!-- Login Panel -->
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="row admin-box">
                <div class="col-lg-4">
                    <h1 class="login-title">Admin Login</h1>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
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
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>

@endsection