@extends(Auth::check() ? 'layouts.main_logged_layout' : 'layouts.main_layout')

@section('content')

<h1>Profile Update page</h1>

@stop