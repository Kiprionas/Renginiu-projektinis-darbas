@extends(Auth::check() ? 'layouts.main_logged_layout_2' : 'layouts.main_layout_2')

@section('content')

    <div class="container-fluid">

        <div class="row bg-dark align-items-center text-white text-center" style="height: 100px;">
            <div class="col">
                <h1>Renginiai Kaune</h1>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col">
                <nav class="navbar navbar-expand navbar-dark bg-dark">
                    <div class="container-fluid justify-content-center">
                        <ul class="navbar-nav">
                            <div class="row">
                                <div class="col">
                                    <li class="nav-item dropdown text-center">
                                        <a class="dropdown-toggle nav-link" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Miestas
                                        </a>
                                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                            @foreach ($cities as $item)
                                                @if ($item == "Visi")
                                                    <li><a href="/main" class="dropdown-item text-white dropdown_element">{{$item}}</a></li>
                                                @else
                                                <li><a href="/main/{{$item}}" class="dropdown-item text-white dropdown_element">{{$item}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </div>
                              <!--  <div class="col">
                                    <li class="nav-item dropdown text-center">
                                        <a class="dropdown-toggle nav-link" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Kategorijos
                                        </a>
                                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                            @foreach ($categories as $item)
                                                <li><a href="/category={{$item}}" class="dropdown-item text-white dropdown_element">{{$item}}</a></li>   
                                            @endforeach
                                        </ul>                                    
                                    </li>
                                </div>
                                <div class="col">
                                    <li class="nav-item text-center">
                                        <a href="/?price=nemokami" class="nav-link dropdown_element">Nemokami</a>
                                    </li>
                                </div>-->
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            @foreach ($posts as $post)

                @php $post->price == 0 ? $price = 'Nemokamas' : $price = $post->price;
                     $post->start_day == $post->end_day ? $day = $post->start_day : $day = $post->start_day. " - ". $post->end_day;
                     $post->number_of_seats == 0 ? $number_of_seats = "Neribotas" : $number_of_seats = $post->number_of_seats;
                @endphp

                @if (date("Y-m-d") <= $post->start_day)
                    <div class="col">
                        <a href="/post/{{$post->id}}" class="link-dark text-decoration-none">
                            <div class="card mb-3 fs-5 position-relative" style="max-width: 540px; height: 300px;">
                                <div class="row g-0">
                                    <div class="col-4 mx-auto">
                                        <img src="{{$post->picture}}" alt="..." class="img-fluid img-thumbnail"> 
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <p class="card-title fs-5 p-0 m-0">{{$post->eventname}}</p>
                                            <p class="card-text text-end p-0 m-0"><small class="text-muted">{{$day}}</small></p>
                                            <p class="card-text text-end p-1 m-0"><small class="text-muted">{{$post->start_time}} - {{$post->end_time}}</small></p>
                                            <p class="card-text description">{{$post->description}}</p>
                                            <p class="card-text">Vietu skaicius: {{$number_of_seats}}</p>
                                        </div>
                                        <div class="position-absolute bottom-0 end-0">
                                            <div class="pt2">
                                                <p class="card-text text-end"><small class="text-muted">{{$price}}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>                    
                @endif    

            @endforeach
        </div>

    </div>

    <script type="text/javascript">// <![CDATA[
        $(function(){
          $(".description").each(function(i){
            len=$(this).text().length;
            if(len>130)
            {
              $(this).text($(this).text().substr(0,130)+'...');
            }
          });
        });
        // ]]></script>
        

@stop
 