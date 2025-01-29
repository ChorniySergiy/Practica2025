@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h1>Welcome to Our Blog Platform</h1>

    <h2>Список Блог</h2>

    <div class="my-3">
        <form method="GET" action="{{ route('home') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField">Сортувати за:</label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" {{ request('sortField') == 'title' ? 'selected' : '' }}>Назва</option>
                        <option value="author_id" {{ request('sortField') == 'author_id' ? 'selected' : '' }}>Автор</option>
                        <option value="publish_date" {{ request('sortField') == 'publish_date' ? 'selected' : '' }}>Дата публікації</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="sortOrder">Напрямок:</label>
                    <select name="sortOrder" id="sortOrder" class="form-control">
                        <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>За зростанням</option>
                        <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>За спаданням</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Сортувати</button>
                </div>
            </div>
        </form>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Зображення</th>
                <th>Author</th>
                <th>Publish Date</th>
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
                        <span>Відсутная зображення</span>
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