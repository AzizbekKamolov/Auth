@extends('../layouts.app')
@section('content')
    <h1 class="text-center">Dashboard</h1>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td><a href="/logout">Logout</a></td>
        </tr>
        </tbody>
    </table>
    <br/>
    <br/>
    <form action="{{ route('postCreate') }}" method="post">
        @if(Session::has('succsess'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" class="form-control" id="title" name="title" value="{{ old('title') }}">
            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
        </div>
        <div class="mb-3">
            <textarea name="text" id="text" cols="149" rows="3" placeholder="Enter description" class="form-label"></textarea>
            <span class="text-danger">@error('text'){{ $message }}@enderror</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <br>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->text }}</td>
            <td>
                <a href="">view</a>
                <a href="">edit</a>
                <a href="">delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
