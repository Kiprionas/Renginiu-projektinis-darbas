@extends('layouts.main_layout') 

@section('content')

    <div class="container-fluid mt-5 d-sm-flex justify-content-sm-center">
        <div class="col-lg-4 col-sm border border-danger border-2 mt-5">
            <form action="/forgot-password" method="POST">

                @csrf

                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@sth.com">
                    </div>
                </div>
                
                <div class="row p-3 me-1">
                    <div class="col">
                        <div class="col justify-content-end d-flex">
                            <button class="btn btn-secondary">Confirm</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
    </div>

@stop
