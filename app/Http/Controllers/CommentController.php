<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
        ]);
    
        Comment::create([
            'blog_id' => $blog->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'content' => $validated['content'],
        ]);
    
        return redirect()->route('blogs.show', $blog->id)->with('success', 'Ваш комент було добавлено!');
    }

    public function index($sort = 'new')
    {
        $order = ($sort === 'old') ? 'asc' : 'desc';

        // Отримуємо всі коментарі, сортуємо за датою створенняц
        $comments = Comment::with('blog')->orderBy('created_at', 'desc')->get();

        return view('blogs.comments', compact('comments', 'sort'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments')->with('success', 'Коментар успішно видалено!');
    }
}
