<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }  
      
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->withSuccess('Signed in');
        }
        return redirect("login")->withErrors('Login details are not valid')->withInput(['email' => $request->email]);
    }

    public function register()
    {
        return view('auth.register');
    }
      
    public function create(Request $request)
    {  
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
           
        $data = $request->all();
        $check = $this->store($data);
         
        return redirect("login")->withSuccess('You have signed-in');
    }

    public function store(array $data)
    {
      return User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone' => $data['phone'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect('/')->withSuccess('You have signed-out');
    }
}