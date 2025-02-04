<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $blogs = Blog::with('author')->paginate(10); 
        return view('home', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        
        return view('blogs.edit', compact('blog'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('dashboard')->with('success', 'Blog deleted successfully!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publish_date' => 'required|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // Оголошуємо змінну $file

            $imageName = $file->hashName(); // Генерує унікальне ім'я
            $file->storeAs('blog_images', $imageName, 'public'); // Зберігає в storage/app/public/blog_images
            $imagePath = $imageName; // Зберігаємо лише ім'я файлу
        } else {
            $imagePath = null; // Якщо зображення немає
        }

        Blog::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'author_id' => auth()->id(),
            'publish_date' => $validatedData['publish_date'],
            'image' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Blog created successfully!');
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Оновлення зображення
        if ($request->hasFile('image')) {
            // Видаляємо старе зображення
            if ($blog->image) {
                Storage::disk('public')->delete('blog_images/' . $blog->image);
            }

            // Отримуємо нове зображення
            $file = $request->file('image');
            
            // Генеруємо унікальне ім'я для зображення або використовуємо ім'я файлу
            $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Зберігаємо нові зображення
            $file->storeAs('blog_images', $imageName, 'public');

            $blog->image = $imageName;
        }

        $blog->title = $validated['title'];
        $blog->content = $validated['content'];
        $blog->publish_date = $validated['publish_date'];

        $blog->save();

        return redirect()->route('dashboard')->with('success', 'Блог оновлено успішно!');
    }


    public function show($id)
    {
        $blog = Blog::find($id);
        
        //Перевіряємо, чи знайдено блог
        if (!$blog) {
            return redirect()->route('home')->with('error', 'Blog not found');
        }

        return view('blogs.show', compact('blog'));
    }


    public function welcome(Request $request)
    {
        //сортування
        $sortField = $request->get('sortField', 'title'); 
        $sortOrder = $request->get('sortOrder', 'asc');

        //із БД
        $allowedFields = ['title', 'author_id', 'publish_date'];

        // Перевіряємо
        if (!in_array($sortField, $allowedFields)) {
            $sortField = 'title'; 
        }

        $blogs = Blog::with('author')->orderBy($sortField, $sortOrder)->paginate(10);
        return view('welcome', compact('blogs', 'sortField', 'sortOrder'));
    }
}
