@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <p>{{ __('messages.welcomemy') }}, {{ Auth::user()->name }}!</p>

    <h2>{{ __('messages.yourblogs') }}</h2>

    <div class="mb-3">
        <a href="{{ route('blogs.create') }}" method="get" class="btn btn-primary">
            {{ __('messages.create_blog') }}
        </a>

        <a href="{{ route('comments.index') }}" method="get" class="btn btn-primary">
            {{ __('messages.list_of_comments') }}
        </a>
    </div>

    <div class="my-3">
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField">{{ __('messages.sortby') }}</label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" {{ request('sortField') == 'title' ? 'selected' : '' }}>{{ __('messages.title') }}</option>
                        <option value="created_at" {{ request('sortField') == 'created_at' ? 'selected' : '' }}>{{ __('messages.creation_date') }}Дата створення</option>
                        <option value="updated_at" {{ request('sortField') == 'updated_at' ? 'selected' : '' }}>{{ __('messages.update_date') }}Дата оновлення</option>
                        <option value="publish_date" {{ request('sortField') == 'publish_date' ? 'selected' : '' }}>{{ __('messages.publish_date') }}Дата публікації</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="sortOrder">{{ __('messages.direction') }}</label>
                    <select name="sortOrder" id="sortOrder" class="form-control">
                        <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>{{ __('messages.ascending') }}</option>
                        <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>{{ __('messages.descending') }}</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">{{ __('messages.sort') }}</button>
                </div>
            </div>
        </form>
    </div>

    <!--Список блогів -->
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.image') }}</th>
                <th>{{ __('messages.author') }}</th>
                <th>{{ __('messages.creation_date') }}</th>
                <th>{{ __('messages.update_date') }}</th>
                <th>{{ __('messages.publish_date') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td><a href="{{ route('blogs.edit', $blog->id) }}">{{ $blog->title }}</a></td>
                    <td>
                        @if ($blog->image)
                            <img src="{{ asset('storage/blog_images/' . $blog->image) }}" alt="Зображення" style="width: 100px; height: auto;">
                        @else
                            <span>{{ __('messages.emplyimage') }}</span>
                        @endif
                    </td>
                    <td>{{ $blog->author->name }}</td>
                    <td>{{ $blog->created_at->format('d M, Y') }}</td>
                    <td>{{ $blog->updated_at->format('d M, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</td>
                    <td>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                                &#10006; Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Пагінація -->
    <div class="pagination d-flex justify-content-center">
        {{ $blogs->links('pagination::bootstrap-4') }}
    </div>
    
@endsection