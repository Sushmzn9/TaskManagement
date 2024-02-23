@extends('layouts.master')

@section('content')

<h1>Update a New Department</h1>
<form action="{{route('departments.update', $department->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{$department->name}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="director_id" class="name">Director</label>
                <select name="director_id" class="form-control">
                    <option value="" selected>Select a person</option>
                    <option value="1" @if($department->director_id == "1") selected @endif>IT Director</option>
                    <option value="2" @if($department->director_id == "2") selected @endif>HR Director</option>
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