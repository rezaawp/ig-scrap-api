@extends('layouts.bootstrap')

@section('title', 'Halaman Login')

@section('content')
    <form method="POST" action="">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                name="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
