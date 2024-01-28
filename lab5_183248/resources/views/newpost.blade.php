<!-- resources/views/newpost.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Post') }}</div>

                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="body" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="author">Author:</label>
                                <select name="author" id="author" class="form-control" required>
                                    <!-- Loop through users to populate the dropdown -->
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach                             
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug:</label>
                                <!-- <textarea name="slug" id="slug" class="form-control" required></textarea> -->
                                <input type="text" name="slug" id="slug" class="form-control" required>
                            </div>
                            <!-- Add other form fields if needed -->
                            <button type="submit" class="btn btn-primary">Add Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection