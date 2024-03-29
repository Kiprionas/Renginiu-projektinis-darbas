<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

        <title>Laravel</title>
        
    </head>

    <body>

        <div class="container-fluid">

            <div class="row bg-dark">   
                <nav class="navbar navbar-expand navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a href="/" class="navbar-brand ms-5 ">MAIN</a>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">Register</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="row">
                <img src="images/kaunas.jpg" alt="Kaunas">
            </div>
            
            <div class="row">
                @yield('content')
            </div>


        </div>
        
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>
</html>
