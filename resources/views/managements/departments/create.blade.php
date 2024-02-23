@extends('layouts.master')

@section('content')

<h1>Create a New Department</h1>
<form action="{{route('departments.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="director_id" class="name">Director</label>
                <select name="director_id" class="form-control">
                    <option value="" selected>Select a person</option>
                    <option value="1">IT Director</option>
                    <option value="2">HR Director</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success mt-5 float-right">
                Save
            </button>

        </div>
    </div>
</form>
@endsection