@extends('layouts.auth')

@section('content')
<div class="row" mt-5 pt-5>
    <div class="col-md-12">
        <h3>Login to Task System</h3>
        <div class="card">
            <div class="card-header bg-secondary">
                <h5 class="text-center text-light">
                    Login
                </h5>

            </div>
            <div class="card-body">
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group my-1">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control ">

                    </div>
                    <div class="form-group my-1">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group my-1">
                                <button type="submit" class="btn btn-warning">Login</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('register')}}" class="btn btn-dark my-1">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection