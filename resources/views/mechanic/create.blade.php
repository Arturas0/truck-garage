@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create mechanic</div>
                <form method="POST" action="{{route('mechanic_store')}}">
                    <div class="form-abe box mb-5">

                        <label class="custom-field one">
                            <input type="text" name="mechanic_name" placeholder=" " />
                            <span class="placeholder">Enter Name</span>
                        </label>

                        <label class="custom-field one">
                            <input type="text" name="mechanic_surname" placeholder=" " />
                            <span class="placeholder">Enter Surname</span>
                        </label>

                        @csrf
                        <button class="btn btn-primary ml-4 mt-3" type="submit">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
