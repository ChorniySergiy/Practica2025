@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="container">
    <h2>Всі список коментарія</h2>

    <div class="mb-3">
        <a href="{{ route('blogs.comments', 'new') }}" class="btn btn-primary {{ $sort === 'new' ? 'active' : '' }}">
            Нові комент
        </a>
        <a href="{{ route('blogs.comments', 'old') }}" class="btn btn-secondary {{ $sort === 'old' ? 'active' : '' }}">
            Старі комент
        </a>
    </div>

    @if($comments->isEmpty())
        <p>Немає коментарів у базі даних.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ім'я</th>
                    <th>Коментар</th>
                    <th>Дата створення</th>
                    <th>До блогу</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $comment->blog->id) }}">
                                {{ $comment->blog->title }}
                            </a>
                        </td>
                        <td>
                            <!-- Дії: видалення або редагування -->
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div> 
@endsection
