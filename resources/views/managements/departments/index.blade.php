@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Departments</h1>

    </div>
    <div class="col-md-6">
        <a href="{{route('departments.create')}}" class="btn btn-success float-right mt-2">Create New Departments</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thred>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Director</th>
                        <th>Action</th>
                    </tr>
                </thred>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$department->name }}</td>
                        <td>{{$department->director_id }}</td>
                        <td>
                            <div class="float-left mx-1"> <a href="{{route('departments.edit',$department->id)}}" class="btn-success btn">Edit</a>
                            </div>
                            <div class="float-left mx-1">
                                <form action="{{route('departments.delete',$department->id)}}" method="POST">
                                    @csrf
                                    @method("Delete")
                                    <button class="btn-danger btn">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection