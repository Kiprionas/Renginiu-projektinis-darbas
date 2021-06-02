@extends('layouts.main_layout') 

@section('content')

    <div class="container-fluid mt-5 d-sm-flex justify-content-sm-center">
        <div class="col-lg-4 col-sm border border-danger border-2 mt-5">
            <form action="/login_method" method="POST">

                @csrf

                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@sth.com">
                    </div>
                </div>
                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                @if ($errors->any())
                    <div class="row p-4 pb-1">
                        <div class="row">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger text-center">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="row p-4 pb-1">
                    <div class="col">
                        <input type="checkbox" id="rememberMe" name="remember" value="True">
                        <label for="rememberMe">Remember me!</label>
                    </div>
                </div>
                <div class="row p-3 me-1">
                    <div class="col">
                        <div class="col justify-content-end d-flex">
                            <button class="btn btn-secondary">Login</button>
                        </div>
                    </div>
                </div> 
                <div class="row p-2 pb-4 text-center">
                    <div class="col">
                        <a href="/forgot-password">Forgot password?</a>
                    </div>
                </div> 
            </form>
        </div>
    </div>

@stop
