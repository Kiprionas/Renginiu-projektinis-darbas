@extends(Auth::check() ? 'layouts.main_logged_layout' : 'layouts.main_layout')

@section('content')

    <div class="container-fluid d-sm-flex justify-content-sm-center">
        <div class="col-lg-4 col-sm border border-danger border-2 mt-5">
            <form action="/update_post/{{$post_info[0]->id}}" method="POST">

                @csrf

                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="eventname" class="form-label">Renginio pavadinimas</label>
                        <input type="text" class="form-control" id="eventname" name="eventname" value="{{$post_info[0]->eventname}}" >
                    </div>
                </div>
                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="description" class="form-label">Renginio aprasymas</label>
                        <textarea id="description" name="description" class="form-control" rows="5" >{{$post_info[0]->description}}</textarea>
                    </div>
                </div>
                <div class="row p-4 pb-1">
                    <div class="col text-center text-sm-start">
                        <label for="dates" class="class-label">Renginio datos</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="date" class="class-control" id="dates" name="start_date" value="{{$post_info[0]->start_day}}">
                        <input type="date" class="class-control" id="dates" name="end_date" value="{{$post_info[0]->end_day}}">
                    </div>
                </div>
                <div class="row p-4 pb-1">
                    <div class="col px-0">
                        <label for="times" class="form-label">Renginio pradzia</label>
                        <input type="number" min="0" max="23" class="class-control" id="times" name="start_hour" style="width: 70px" value="{{$start[0]}}" > :
                        <input type="number" min="0" max="59" class="class-control" id="times" name="start_minute" style="width: 70px" value="{{$start[1]}}" >
                    </div>
                    <div class="col px-0">
                        <label for="times" class="form-label">Renginio pabaiga</label>
                        <input type="number" min="0" max="23" class="class-control" id="times" name="end_hour" style="width: 70px" value="{{$end[0]}}" > :
                        <input type="number" min="0" max="59" class="class-control" id="times" name="end_minute" style="width: 70px" value="{{$end[1]}}" >
                    </div>
                </div>        
                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="file" class="form-label">Nuotrauka</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                </div>
                <div class="row p-4 pb-1">
                    <div class="col">
                        <label for="price" class="form-label">Renginio kaina</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span> 
                            <input type="text" class="form-control" id="price" name="price" value="{{$post_info[0]->price}}"> 
                        </div>     
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
                            <input type="submit">
                        </div>
                    </div>
                </div>  
            </form>
        </div>
    </div>


@stop