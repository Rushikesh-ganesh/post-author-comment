@extends('layouts.app')

@section('content')
<div class="container">


    @if (isset($post_data))
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> 
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card">
        <div class="card-header">
          Edit Post
        </div>
        <div class="card-body">
            <form action="{{route('update_post', $post_data->id)}}" id="update_post" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="{{$post_data->post_title}}">
                </div>
                <div class="form-group">
                    <label for="post_description">Post Description</label>
                    <textarea class="form-control" id="post_description" name="post_description" rows="3">{{$post_data->post_description}}</textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">
          Create Post
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> 
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{route('post_submit')}}" id="create_post" method="post">
                @csrf
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="{{old('post_title')}}">
                  
                </div>
                <div class="form-group">
                    <label for="post_description">Post Description</label>
                    <textarea class="form-control" id="post_description" name="post_description" rows="3">{{old('post_description')}}</textarea>
                   
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    @endif

@endsection
@push('scripts')

<script>
    $( document ).ready(function() {
        $("#create_post").validate({
            rules: {
                post_title: {
                    required: true,
                   
                },
                post_description: {
                    required: true,
                   
                },
            },
            messages: {
                post_title: {
                    required: "Post Title is requried",
                },
                post_description: {
                    required: "Post Description is requried",
                },
            },
        });
        $("#update_post").validate({
            rules: {
                post_title: {
                    required: true,
                   
                },
                post_description: {
                    required: true,
                   
                },
            },
            messages: {
                post_title: {
                    required: "Post Title is requried",
                },
                post_description: {
                    required: "Post Description is requried",
                },
            },
        });
    }); 
</script>
@endpush