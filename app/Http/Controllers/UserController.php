<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login_form()
    {
        $Title = 'Login ~ Article-Zone';
        return view('login', [
            'title' => $Title
        ]);
    }

    public function login(Request $request)
    {
        $user = User::firstWhere('email', $request->email);
        if (!$user) return redirect()->back()->with('status', 'Data anda tidak dapat ditemukan.');
        $dbPassword     = $user->password;
        $hashedPassword = Hash::check($request->password, $dbPassword);
        if ($hashedPassword) {
            $token = Str::random(16);
            Session::put('token', $token);
            $user->update([
                'token' => $token
            ]);
            return to_route('home');
        } else {
            return redirect()->back()->with('status', 'Data anda tidak sesuai.');
        }
    }

    public function register_form()
    {
        $Title = 'Register ~ Article-Zone';
        return view('register', [
            'title' => $Title
        ]);
    }

    public function register(RegisterUsersRequest $request)
    {
        $request->validated();
        if ($request->hasFile('profile')) {
            $profile = $request->profile;
            $profile->storeAs('img/profile', $profile->hashName());
        }

        $UserCreated = User::create([
            'name'                    => $request->name,
            'email'                   => $request->email,
            'password'                => Hash::make($request->password),
            'profile'                 => $profile->hashName(),
        ]);
        if ($UserCreated) return to_route('login.form')->with('message', 'User Created');
        return to_route('register.form')->with('message', 'User Created failed.');
    }

    public function logout(Request $request, User $user)
    {
        $user->where('token', $request->token)->update([
            'token' => NULL
        ]);
        Session::remove('token');
        return to_route('home')->with('message', 'Logged Out');
    }

    public function profile($email)
    {
        $User = User::firstWhere('email', $email);
        if (!$User) return redirect()->back();
        $Title = Str::of($User->name)->ucfirst() . ' ~ Article-Zone';
        return view('profile', [
            'title' => $Title,
            'user'  => $User,
        ]);
    }

    public function users_list()
    {
        $Title = 'Article-Zone ~ Tags-List';
        $Users  = User::orderBy('name', 'asc')->paginate(6);
        $User = User::firstWhere('token', Session::get('token'));
        return view('users-list', [
            'title' => $Title,
            'users'  => $Users,
            'meta'     => [
                'nextPage'      => $Users->nextPageUrl(),
                'prevPage'      => $Users->previousPageUrl(),
                'currentPage'   => $Users->currentPage()
            ],
            'user'  => $User
        ]);
    }
}
