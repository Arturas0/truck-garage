@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All trucks
                    <div class="car-header__filter">
                        <form action="{{route('truck_index')}}" method="GET">
                            <div class="row">
                                <div class="form-group mt-3 col-6">
                                    <label for="mechanic">Select mechanic</label>
                                    <select class="form-control" name="filter[mechanic]" id="mechanic">
                                            <option value="all" hidden>
                                            Filter by
                                        </option>
                                        @foreach ($mechanics as $mechanic)
                                        <option value="{{$mechanic->id}}" @if($mechanic->id === $mechanic_id) selected
                                            @endif>
                                            {{$mechanic['firstname']}} {{$mechanic['lastname']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-3 col-6">
                                    <label for="maker">Select car maker</label>
                                    <select class="form-control" name="filter[maker]" id="maker">
                                        <option value="all" hidden>
                                            Filter by
                                        </option>
                                        @foreach ($truckMakers as $truckMaker)
                                        <option value="{{$truckMaker->maker}}" @if($truckMaker->maker === $maker)
                                            selected @endif>
                                            {{$truckMaker['maker']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <button class="btn btn-primary" type="submit">FILTER</button>
                                    <a href="{{route('truck_index')}}" class="btn btn-warning m-2">RESET</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($trucks as $truck)
                    <div class="card-body__flex">
                        <div class="col-8">
                            <span>Truck: {{$truck->maker}}, </span>
                            <span>plate number: {{$truck->plate}}, </span>
                            <span>assigned to:  {{$truck->truckMechanic->firstname}} {{$truck->truckMechanic->lastname}}</span>
                        </div>
                        <div class="col-4 card-body__flex__element">
                            <div>
                            <a class="btn btn-success" href="{{route('truck_edit', [$truck])}}">Show more</a>
                        </div>
                        <div>
                            <form action="{{route('truck_destroy', $truck)}}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit">DELETE</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
