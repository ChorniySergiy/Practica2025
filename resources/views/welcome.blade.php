@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h1>{{ __('messages.welcome') }}</h1>

    <h2>{{ __('messages.listblog') }}</h2>

    <div class="my-3">
        <form method="GET" action="{{ route('home') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField">{{ __('messages.sortby') }}</label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" {{ request('sortField') == 'title' ? 'selected' : '' }}>{{ __('messages.title') }}</option>
                        <option value="author_id" {{ request('sortField') == 'author_id' ? 'selected' : '' }}>{{ __('messages.author') }}</option>
                        <option value="publish_date" {{ request('sortField') == 'publish_date' ? 'selected' : '' }}>{{ __('messages.publish_date') }}</option>
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


    <table class="table">
        <thead>
            <tr>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.image') }}</th>
                <th>{{ __('messages.author') }}</th>
                <th>{{ __('messages.publish_date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></td>
                <td>
                    @if ($blog->image)
                        <img src="{{ asset('storage/blog_images/' . $blog->image) }}" alt="Зображення" style="width: 100px; height: auto;">
                    @else
                        <span>{{ __('messages.emplyimage') }}</span>
                    @endif
                </td>
                <td>{{ $blog->author->name ?? 'Unknown' }}</td>
                <td>{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Пагінація -->
    <div class="pagination d-flex justify-content-center">
        {{ $blogs->links('pagination::bootstrap-4') }}
    </div>

@endsection