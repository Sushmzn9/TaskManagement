@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Create a New Permission</h1>
    </div>
    <div class="card-body">
        <form action="{{route('permission.store')}}" method="POST">
            @csrf
            <permission-create></permission-create>
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