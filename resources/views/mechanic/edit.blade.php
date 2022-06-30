@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit mechanic</div>
                <div class="card-body">
                    <form action="{{route('mechanic_update', $mechanic)}}" method="POST">
                        Name: <input type="text" name="firstname" value="{{$mechanic->firstname}}">
                        Surname: <input type="text" name="lastname" value="{{$mechanic->lastname}}">
                        @csrf
                        <button type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
