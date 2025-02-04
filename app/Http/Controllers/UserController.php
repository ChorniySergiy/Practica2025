<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog; // Імпорт моделі Blog
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Імпорт фасаду Auth
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create($request->all());
        event(new Registered($user));

        Auth::login($user);// Тепер фасад Auth розпізнається

        //return redirect()->route('verification.notice'); для вертифікація
        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('user.login');
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',],
        ]);

        if(Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Welcome, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Wrong email or password',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function dashboard(Request $request)
    {
        //сортування
        $sortField = $request->get('sortField', 'title'); 
        $sortOrder = $request->get('sortOrder', 'asc');

        //із БД
        $allowedFields = ['title', 'author_id', 'created_at', 'updated_at', 'publish_date'];

        // Перевіряємо, чи поле сортування дозволене
        if (!in_array($sortField, $allowedFields)) {
            $sortField = 'title'; 
        }

        // Завантажує всі блоги поточного користувача
        $blogs = Blog::where('author_id', Auth::id())->orderBy($sortField, $sortOrder)->paginate(10);
        
        return view('user.dashboard', compact('blogs', 'sortField', 'sortOrder'));
    }
    
    public function forgotPasswordStore(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password), // Хешування пароля
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
