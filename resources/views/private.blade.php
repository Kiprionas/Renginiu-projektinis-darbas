<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main_css.css">
        <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>

        <title>Laravel</title>
        
    </head>

    
    <body>

        <div class="container-fluid">
            <div class="row bg-light">   
                <nav class="navbar navbar-expand navbar-light bg-light">
                    <div class="container-fluid">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/private/users" class="nav-link me-4 fs-5">Users</a>
                            </li>
                            <li class="nav-item">
                                <a href="/private/posts" class="nav-link fs-5">Posts</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>      
        </div>

            @if($what == 'users')
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name - Surname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                @foreach($data as $item)
                                    @if($item->isAdmin != 1)
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>{{$item->name}} - {{$item->surname}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td><a class="btn btn-secondary btn-sm" href="/private/delete_user/{{$item->id}}">Delete</a></td>
                                        </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
            @elseif($what == 'posts')
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pavadinimas - Miestas</th>
                                <th scope="col">Kurejo ID</th>
                                <th scope="col">Kaina</th>
                                <th scope="col">Created_at</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            @foreach($data as $item)
                                <tbody>
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->eventname}} - {{$item->city}}</td>
                                    <td>{{$item->user_id}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td><a class="btn btn-secondary btn-sm" href="/private/delete_event/{{$item->id}}">Delete</a></td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            @else
                <h1>Nothing</h1>
            @endif
                

    </body>

</html>