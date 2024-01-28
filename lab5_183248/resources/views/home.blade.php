@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    

                        <h2>All Posts</h2>
                        <a href="{{ route('newpost') }}" class="btn btn-primary">New Post</a>


                        @forelse($posts as $post)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4 class="card-text"><small class="text-muted">Author: {{ optional($post->author_id)->name }}</small></p>    
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->body }}</p>
                                        <h6>Comments</h6>
                                            <p>No comments yet.</p>
                                    <p class="card-text"><small class="text-muted">Published on: {{ $post->published_on }}</small></p>
                                    <!-- Add more details if needed -->
                                </div>
                            </div>
                        @empty
                            <p>No posts available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

