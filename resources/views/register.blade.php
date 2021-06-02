@extends('layouts.main_layout') 

@section('content')

    <div class="container-fluid mt-2 d-sm-flex justify-content-sm-center">
        <div class="col-lg-4 col-sm border border-danger border-2">
            <form action="/register_method" method="POST">

                @csrf

                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John" required>
                    </div>
                </div>
                <div class="row p-4 pb-0 pt-3">
                    <div class="col">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Peteson" required>
                    </div>
                </div>
                <div class="row p-4 pb-0 pt-3">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@sth.com" required>
                    </div>
                </div>
                <div class="row p-4 pb-0 pt-3">
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="row p-4 pb-0 pt-3">
                    <div class="col">
                        <label for="repPassword" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" id="repPassword" name="repPassword" required>
                    </div>
                </div>
                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="file" class="form-label">Nuotrauka</label>
                        <input type="file" class="form-control" id="file" name="file">
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
                <div class="row p-3 me-1">
                    <div class="col">
                        <div class="col justify-content-end d-flex">
                            <button class="btn btn-secondary">Regiser</button>
                        </div>
                    </div>
                </div>  
            </form>
        </div>
    </div>

@stop