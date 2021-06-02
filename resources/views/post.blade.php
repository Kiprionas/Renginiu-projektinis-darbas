@extends(Auth::check() ? 'layouts.main_logged_layout' : 'layouts.main_layout')

@section('content')

    <div class="container-fluid justify-content-center">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-6 border border-danger border-2">
                <div class="row">
                    <div class="col-lg-4 p-3">
                        <img src="{{$post_info[0]->picture}}" alt="...">
                    </div>
                    <div class="col-lg-8 p-2 pe-3">
                        <p class="fs-3 text-center">Pavadinimas: {{$post_info[0]->eventname}}</p>
                        <p name="description" class="fs-5 pt-2 ">Aprasymas: {{$post_info[0]->description}}</p>
                        <p class="fs-5">Data/laikas: {{$post_info[0]->start_day}} - {{$post_info[0]->end_day}} / {{$post_info[0]->start_time}} h - {{$post_info[0]->end_time}} h</p>
                        <p class="fs-5">Likusiu vietu skaicius: @php if($post_info[0]->number_of_seats == 0 ){echo "Neribotas";}else{echo $post_info[0]->number_of_seats;} @endphp</p>
                        <p class="fs-5">
                            <span class="text-start">Kaina: @php if($post_info[0]->price == 0){echo "Nemokamas";}else{echo $post_info[0]->price;} @endphp</span>
                            @if ($allow_update != false)
                                <span class='text-end'><a class='btn btn-secondary' href='/post/update/{{$post_info[0]->id}}'>Redaguoti</a></span>
                            @endif
                            @if (!in_array($post_info[0]->id, $bought_events) && $post_info[0]->number_of_seats == 0 && $post_info[0]->price == 0)
                                <span class="text-end"><a href="/post/buy/{{$post_info[0]->id}}" class="btn btn-secondary">Rezervuoti</a></span>
                            @elseif (in_array($post_info[0]->id, $bought_events) && $post_info[0]->number_of_seats == 0 && $post_info[0]->price == 0)
                                <span class="text-end"><a href="/post/buy/{{$post_info[0]->id}}" class="btn btn-secondary disabled text-decoration-line-through">Rezervuota</a></span>
                            @elseif (in_array($post_info[0]->id, $bought_events) || $post_info[0]->number_of_seats == 0)
                                <span class="text-end"><a href="/post/buy/{{$post_info[0]->id}}" class="btn btn-secondary disabled text-decoration-line-through">Pirkti</a></span>
                            @else
                                <span class="text-end"><a href="/post/buy/{{$post_info[0]->id}}" class="btn btn-secondary">Pirkti</a></span>
                            @endif
                        </p>
                        <div class="text-center">
                            @if ($errors->any())
                                <p class="fs-3 text-danger">{{$errors->first()}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop