@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>update a New Roles</h1>
    </div>
    <div class="card-body">
        <form action="{{route('roles.update', $role->id)}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$role->name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="display_name" class="name">Display_Name</label>
                        <input type="text" class="form-control" name="display_name" value="{{$role->display_name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description" class="name">Description</label>
                        <input type="text" class="form-control" name="description" value="{{$role->description}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success mt-5 float-right">
                        Update
                    </button>
        
                </div>
            </div>
        </form>
    </div>
</div>

@endsection