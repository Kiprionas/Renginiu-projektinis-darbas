@extends(Auth::check() ? 'layouts.main_logged_layout' : 'layouts.main_layout')

@section('content')

    <div class="container-fluid justify-content-center">
        <div class="row clearfix justify-content-center mt-5">
            <div class="col-lg-6">
                <div class="card mb-3" style="max-width: auto;">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <img src="{{$user_info->picture}}" alt="...">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body">
                                <h5 class="card-title fs-4">User info</h5>
                                <p class="card-text fs-5">Name - Surname: {{$user_info->name}} - {{$user_info->surname}}</p>
                                <p class="card-text fs-5">Email: {{$user_info->email}}</p>
                                <p class="card-text fs-5">
                                    Events created:
                                    @php 
                                    $post_created = explode(", ", $user_info->events_created);
                                    foreach ($post_created as $item){
                                        echo "<a href='/post/$item'>$item</a>". " ";
                                    }
                                @endphp
                                <p class="card-text fs-5">
                                    Events bought:
                                    @php
                                        $post_bought = explode(", ", $user_info->events_bought);
                                        foreach($post_bought as $item){
                                            echo "<a href='/post/$item'>$item</a>". " ";
                                        }
                                    @endphp
                                </p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="text-end me-3 mb-3">
                        <a href="/profile/update" class="btn btn-secondary">Update profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
