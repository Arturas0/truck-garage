@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All trucks</div>
                <div class="card-body">
                    @foreach ($trucks as $truck)
                    <a href="{{route('truck_edit', [$truck])}}">{{$truck->maker}} {{$truck->plate}} –
                        {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}</a>
                    <form action="{{route('truck_destroy', $truck)}}" method="POST">
                        @csrf
                        <button type="submit">DELETE</button>
                    </form>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
