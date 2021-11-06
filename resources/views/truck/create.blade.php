@extends('layouts.app')

@section('title')
Register truck
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register truck</div>
                <div class="card-body">
                    <form action="{{route('truck_store')}}" method="POST">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Maker</label>
                                <input type="text" name="truck_maker" class="form-control" value="{{ old('truck_maker') }}">
                                <small class="form-text text-muted">Sunkvežimio pavadinimas</small>
                            </div>
                            <div class="form-group col-6">
                                <label>Plate number</label>
                                <input type="text" name="truck_plate" class="form-control"
                                    value="{{ old('truck_plate') }}">
                                <small class="form-text text-muted">Sunkvežimio valstybinis numeris</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Make year</label>
                                <input type="text" name="truck_make_year" class="form-control"
                                    value="{{ old('truck_make_year') }}">
                                <small class="form-text text-muted">Pagaminimo metai</small>
                            </div>
                            <div class="form-group col-6">
                                <label>Mechanic</label>
                                <select name="mechanic_id" class="form-control">
                                    @foreach ($mechanics as $mechanic)
                                    <option value="{{$mechanic->id}}"
                                        @if($mechanic->id == old('mechanic_id')) selected @endif>
                                        {{$mechanic->name}} {{$mechanic->surname}}
                                    </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Priskirtas mechanikas</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mechanic notices</label>
                            <textarea class="form-control" name="mechanic_notices" id="summernote"></textarea>
                            <small class="form-text text-muted">Mechaniko užrašai</small>
                        </div>
                        @csrf
                        <button class="btn btn-primary" type="submit">ADD</button>
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
