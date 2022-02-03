@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-5">Create New Post</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.store')}} " method='POST'>
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content*</label>
            <textarea class="form-control" type="text" name="content" id="content" rows="6"></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Create Post</button>
    </form>
</div>


@endsection