@extends('layouts.app')

@section('content')
<div class="container">
<h1>Blog Posts</h1>

@if(empty($posts))
<p>No post found yet <a href="{{route('admin.posts.create')}}">Create a new one</a> </p>
@else
TABLE HERE
@endif
</div>
@endsection