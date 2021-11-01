@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All trucks
                                        
                    <form action="{{route('truck_index')}}" method="GET">
                        <div class="form-group mt-3">
                            <label for="mechanic">Select mechanic</label>
                        <select class="form-control" name="mechanic" id="mechanic">
                            <option value="default" default>
                                Filter by
                            </option>
                            @foreach ($mechanics as $mechanic)
                            <option value="{{$mechanic->id}}" @if($mechanic->id == $mechanic_id) selected @endif>
                                {{$mechanic['name']}} {{$mechanic['surname']}}
                            </option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group">  
                            <label for="maker">Select car maker</label>           
                        <select class="form-control" name="truck_maker" id="maker">
                            <option value="default" default>
                                Filter by
                            </option>
                            @foreach ($truckMakers as $truckMaker)
                            <option value="{{$truckMaker->maker}}" @if($truckMaker->maker == $truck_maker) selected @endif>
                                {{$truckMaker['maker']}}
                            </option>
                            @endforeach
                        </select>
                        </div>
                            <div class="form-group">
                        <button class="btn btn-primary" type="submit">FILTER</button>
                        <a href="{{route('truck_index')}}" class="btn btn-warning m-2">RESET</a>
                            </div>
                    </form>
                </div>



                <div class="card-body">
                    @foreach ($trucks as $truck)
                    <div class="car-body__flex">
                        <a class="card-body__wrap" href="{{route('truck_edit', [$truck])}}">{{$truck->maker}}
                            {{$truck->plate}} –
                            {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}</a>
                        <form class="card-body__wrap" action="{{route('truck_destroy', $truck)}}" method="POST">
                            @csrf
                            <button class="btn btn-primary mt-2" type="submit">DELETE</button>
                            <hr>
                        </form>
                        <br>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
