@extends('layouts.authentication')

@section('content')
    <form class="form-horizontal form-material" id="loginform" action="index.html">
        <a href="javascript:void(0)" class="text-center db">
            <img src="/img/instansi-logo.png" style="height: 200px;" alt="Home">
            <br>
            <h3>{{ config('app.name') }}</h3>
        </a>
        <div class="form-group m-t-40">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="Username"></div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" required="" placeholder="Password"></div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox checkbox-primary pull-left p-t-0">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup"> Remember me </label>
                </div>
                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i
                            class="fa fa-lock m-r-5"></i> Forgot pwd?</a></div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log
                    In
                </button>
            </div>
        </div>

    </form>
    <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
            <div class="col-xs-12">
                <h3>Recover Password</h3>
                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="Email"></div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                    Reset
                </button>
            </div>
        </div>
    </form>
@endsection