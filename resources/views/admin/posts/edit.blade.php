@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-5">Edit {{$post->title}}</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.update', $post->id)}} " method='POST'>
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input class="form-control" type="text" name="title" id="title" value="{{old('title', $post->title)}}">
            @error('title')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content*</label>
            <textarea class="form-control" type="text" name="content" id="content" rows="6">{{old('content', $post->content)}}</textarea>
        </div>

        {{-- CATEGORIES --}}
        <div class="mb-3">
            <label for="category_id"></label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Uncategorized</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}"
                    @if($category->id == old('category_id', $post->category_id))selected @endif>
                {{$category->name}}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        {{-- TAGS --}}
        <div class="mb-3">
            <h1>Tags</h1>
            @foreach ($tags as $tag)
                <span class="d-inline-block mr-3">
                    <input type="checkbox" name="tags[]" id="tag{{$loop->iteration}}" value="{{$tag->id}}"
                    @if($errors->any() && in_array($tag->id,old('tags',[])))
                     checked 
                     @elseif(!$errors->any() && $post->tags->contains($tag->id))
                     checked
                     @endif>

                    <label for="tag{{$loop->iteration}}">
                        {{$tag->name}}
                    </label>
                </span>
            @endforeach
            @error('tags')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Update Post</button>
    </form>
</div>


@endsection