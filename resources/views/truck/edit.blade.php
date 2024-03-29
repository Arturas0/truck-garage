@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit truck information</div>
                <div class="card-body">
                    <form action="{{route('truck_update', [$truck])}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="truck_maker">Maker</label>
                                <input class="form-control" type="text" name="truck_maker" id="truck_maker"
                                    value="{{$truck->maker}}">
                                    <small class="form-text text-muted">Sunkvežimio pavadinimas</small>
                            </div>
                            <div class="form-group col-6">
                                <label for="truck_plate">Plate number</label>
                                <input class="form-control" type="text" name="truck_plate" value="{{$truck->plate}}">
                                <small class="form-text text-muted">Sunkvežimio valstybinis numeris</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="truck_make_year">Make year</label>
                                <input class="form-control" type="text" name="truck_make_year"
                                    value="{{$truck->make_year}}">
                                    <small class="form-text text-muted">Pagaminimo metai</small>
                            </div>
                            <div class="group-form col-6">
                                <label>Mechanic</label>
                                <select class="form-control" name="mechanic_id" id="mechanic_id">
                                    @foreach ($mechanics as $mechanic)
                                    <option value="{{$mechanic->id}}" @if ($mechanic->id === $truck->mechanic_id)
                                        selected
                                        @endif >
                                        {{$mechanic->firstname}} {{$mechanic->lastname}}
                                    </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Priskirtas mechanikas</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mechanic notices</label>
                            <textarea class="form-control" name="mechanic_notices" id="summernote">{!!$truck->mechanic_notices!!}</textarea>
                            <small class="form-text text-muted">Mechaniko užrašai</small>
                        </div>
                        <img src="{{ $image}}" Paveikslas width="500" height="600"/>
                            <div class="form-group mt-4">
                                <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip">
                          </div>
                        @csrf
                        <button class="btn btn-success" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#summernote').summernote();
    });
    </script>
@endsection

@section('page_title')
Edit truck information
@endsection
