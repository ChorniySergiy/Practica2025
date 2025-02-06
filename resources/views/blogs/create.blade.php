@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h2>{{ __('messages.сreate_a_New_Blog') }}</h2>

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 0.5em; display: flex; flex-direction: column;">
            <label style="margin-bottom: 0.2em" for="title">{{ __('messages.title') }}:</label>
            <input style="border-radius: 36px; border: 2px solid blue; width: 50%; padding: 5px;" 
            type="text" id="title" name="title" value="{{ old('title') }}" required>
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 0.5em; display: flex; flex-direction: column;">
    	    <label style="margin-bottom: 0.2em" for="content">{{ __('messages.content') }}:</label>
    	    <textarea id="content" name="content" style="width: 50%; height: 100px; border: 2px solid blue; 
        border-radius: 10px; padding: 5px;" required>{{ old('content') }}</textarea>
            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 0.5em">
            <label for="image">{{ __('messages.image') }}:</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" onchange="previewImage(event)">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Контейнер для прев'ю вибраного зображення -->
        <div id="image-preview" style="margin-bottom: 1em;">
            <img id="preview" src="#" alt="Вибране зображення" style="max-width: 500px; border-radius: 10px; border: 2px solid blue; display: none;">
        </div>

        <div style="margin-bottom: 0.5em">
            <label for="publish_date">{{ __('messages.creation_date') }}:</label>
            <input type="date" id="publish_date" name="publish_date" value="{{ old('publish_date') }}" required>
            @error('publish_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit">{{ __('messages.сreate_a_New_Blog') }}Створити новий блог</button>
    </form>

    <!-- JavaScript для прев'ю зображення -->
    <script>
        function previewImage(event) {
            let input = event.target;
            let preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Показати зображення
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

