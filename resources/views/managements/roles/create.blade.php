@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Create a New Roles</h1>
    </div>
    <div class="card-body">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="name">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="display_name" class="name">Display_Name</label>
                        <input type="text" class="form-control" name="display_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description" class="name">Description</label>
                        <input type="text" class="form-control" name="description">
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
    </div>
</div>

@endsection