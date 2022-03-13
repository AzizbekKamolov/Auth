@extends('layouts.app')
@section('content')
    <div style="margin:200px ">
        <h4>Registration</h4>
        <hr>
        <form method="post" action="{{ route('registerUser') }}">
            @if(Session::has('succsess'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">First name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/login" style="padding-left: 100px">Already registered !! Login Here</a>
        </form>
    </div>
@endsection
