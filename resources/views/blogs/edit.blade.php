@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h2>{{ __('messages.editblog') }}  </h2>

    <!-- Форма для редагування -->
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Поле для назви -->
        <div style="margin-bottom: 0.5em; display: flex; flex-direction: column;">
        <label style="margin-bottom: 0.2em" for="title">{{ __('messages.title') }}:</label>
            <input style="border-radius: 36px; border: 2px solid blue; width: 50%; padding: 5px;" 
            type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
            @error('title') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Поле для змісту -->
        <div style="margin-bottom: 0.5em; display: flex; flex-direction: column;">
            <label style="margin-bottom: 0.2em" for="content">{{ __('messages.content1') }}</label>
            <textarea id="content" name="content" style="width: 50%; height: 100px; border: 2px solid blue; 
        border-radius: 10px; padding: 5px;" required>{{ old('content', $blog->content) }}</textarea>
            @error('content') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div style="margin-bottom: 0.5em">
            <label for="image">{{ __('messages.image') }}:</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" onchange="previewImage(event)">
            @error('image') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

         <!-- Контейнер для прев'ю вибраного зображення -->
         <div id="image-preview" style="display: flex; align-items: center; gap: 20px; margin-bottom: 0.5em;">
            @if(!empty($blog->image) && file_exists(public_path('storage/blog_images/' . $blog->image)))
            <div style="text-align: center;">
                <p>{{ __('messages.before_changing_the_image_in_the_blog') }}</p>
                <img src="{{ asset('storage/blog_images/' . $blog->image) }}" alt="Зображення до" 
                    style="max-width: 500px; height: auto; border-radius: 10px; border: 5px solid red;">
            </div>
            @else
                <div style="text-align: center;">
                    <p style="color: gray;">{{ __('messages.emplyimage') }}</p>
                </div>
            @endif

            <div style="text-align: center;">
                <p>{{ __('messages.changing_the_image_to_a_new_one') }}</p>
                <img id="preview" src="#" alt="Вибране зображення" 
                    style="max-width: 500px; height: auto; border-radius: 10px; border: 5px solid blue; display: none;">
            </div>
        </div>


        <!-- Поле для дати публікації -->
        <div style="margin-bottom: 0.5em">
            <label for="publish_date">{{ __('messages.publish_date') }}</label>
            <input type="date" id="publish_date" name="publish_date" 
                value="{{ old('publish_date', $blog->publish_date ? \Carbon\Carbon::parse($blog->publish_date)->format('Y-m-d') : '') }}" 
                required>
            <label for="publish_date">{{ old('publish_date', $blog->publish_date) }}</label>
            @error('publish_date') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>
        <!-- Кнопка -->
        <button type="submit">{{ __('messages.update_blog') }}</button>
    </form>

    <!-- JavaScript -->
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