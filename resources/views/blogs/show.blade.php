@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    @if($blog)
        <h1>{{ $blog->title }}</h1>
        
        <p><strong>{{ __('messages.author') }}:</strong> {{ $blog->author->name }}</p> 

        <p><strong>{{ __('messages.creation_date') }}:</strong> 
        {{ $blog->created_at->format('d M, Y') }}</p> 
        
        <p><strong>{{ __('messages.publish_date') }}:</strong> 
        {{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</p> 
        
        <div class="blog-item" style="display: flex; margin-bottom: 20px;">
            @if ($blog->image)
                <!-- Якщо зображення є -->
                <div class="blog-image" style="margin-right: 20px;">
                    <img src="{{ asset('storage/blog_images/' . $blog->image) }}" alt="Зображення" style="width: 150px; height: auto;">
                </div>
                <div class="blog-content">
                    <h3 style="text-align:center">{{ __('messages.content') }}:</h3>
                    <p>{{ $blog->content }}</p>
                </div>
            @else
                <div class="blog-content" style="flex: 1;">
                    <h3 style="text-align:center">{{ __('messages.content') }}:</h3>
                    <p>{{ $blog->content }}</p>
                </div>
            @endif
        </div>


    @else
        <p>{{ __('messages.blog_not_found') }}.</p>
    @endif

    <form action="{{ url()->previous() }}" method="get">
        <button type="submit" class="btn btn-primary">{{ __('messages.back_to_blogs') }}</button>
    </form>

    <h3><center>Коментар</center></h3>

    @if($blog->comments->isEmpty())
    <p>{{ __('messages.no_comments_yet') }}</p>
    @endif
    @foreach ($blog->comments as $comment)
        <div class="comment">
        <p><strong>{{ $comment->user->name ?? "Anonymous" }}</strong>: {{ $comment->content }}</p>

            <p><small>{{ $comment->created_at->format('d M, Y H:i') }}</small></p>
        </div>
    @endforeach

    <form action="{{ route('comments.store', $blog->id) }}" method="POST">
        @csrf
        <input type="hidden" name="blog_id" value="{{ $blog->id }}">

        <div class="form-group">
            <label for="name">{{ __('messages.уour_name') }}:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">{{ __('messages.your_email') }}:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group" style="margin-bottom: 0.5em;">
            <label for="content">{{ __('messages.comments') }}:</label>
            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.post_a_comment') }}</button>
    </form>

@endsection