@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <p>Welcome, {{ Auth::user()->name }}!</p>

    <h2>Ваш Блоги</h2>

    <div class="mb-3">
        <a href="{{ route('blogs.create') }}" method="get" class="btn btn-primary">
            Створити нові Блог
        </a>

        <a href="{{ route('comments.index') }}" method="get" class="btn btn-primary">
            Список коментарів
        </a>
    </div>

    <div class="my-3">
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField">Сортувати за:</label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" {{ request('sortField') == 'title' ? 'selected' : '' }}>Назва</option>
                        <option value="created_at" {{ request('sortField') == 'created_at' ? 'selected' : '' }}>Дата створення</option>
                        <option value="updated_at" {{ request('sortField') == 'updated_at' ? 'selected' : '' }}>Дата оновлення</option>
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

    <!--Список блогів -->
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Зображення</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Publish Date</th>
                <th>Actions</th>
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
                            <span>Відсутная зображення</span>
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