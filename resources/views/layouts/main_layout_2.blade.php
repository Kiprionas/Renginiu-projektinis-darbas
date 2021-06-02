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

    <body class="">

        <div class="container-fluid">

            <div class="row bg-dark">   
                <nav class="navbar navbar-expand navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a href="/main" class="navbar-brand ms-lg-5 ms-md-3 fs-3">MAIN</a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/login" class="nav-link me-4 fs-5">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link fs-5">Register</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            
            <div class="row">
                @yield('content')
            </div>



            <div class="row bg-dark" style="height: auto;">
                <footer class="container-fluid text-white">

                    <div class="row justify-content-center">
                        <div class="col text-start pt-3">
                            <p class="ms-4">Vienas</p>
                            <p class="ms-4">Vienas</p>
                        </div>
                        <div class="col text-center pt-3">
                            <p>Vienas</p>
                            <p>Vienas</p>
                        </div>
                        <div class="col text-end pt-3">
                            <p class="me-4">Vienas</p>
                            <p class="me-4">Vienas</p>
                        </div>
                    </div>
                    
                </footer>
            </div>


        </div>
        
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>
</html>
