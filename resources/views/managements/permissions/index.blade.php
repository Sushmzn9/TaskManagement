@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h5>Permission</h5>
            </div>
            <div class="col-md-6">
                <a href="{{route('permission.create')}}" class="btn btn-success float-right mt-2">Create New Permission</a>
            </div>
        </div>
    </div>
    <div class="card-body">
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thred>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thred>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->display_name }}</td>
                        <td>{{$permission->description }}</td>
                        <td>
                            <div class="float-left mx-1"> <a href="{{route('permission.edit',$permission->id)}}" class="btn-success btn">Edit</a>
                            </div>
                            <div class="float-left mx-1">
                                <form action="{{route('permission.delete',$permission->id)}}" method="POST">
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