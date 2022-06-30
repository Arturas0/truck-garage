@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">Mechanics</div>
                <div class="card-body">
                    @foreach ($mechanics as $mechanic)
                    <a href="{{route('mechanic_edit', [$mechanic])}}">{{$mechanic->firstname}} {{$mechanic->lastname}}</a>
                    <form action="{{route('mechanic_destroy', $mechanic)}}" method="POST">
                        @csrf
                        <button type="submit">DELETE</button>
                        <hr>
                    </form>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
