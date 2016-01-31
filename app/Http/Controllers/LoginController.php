<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function($view) {
//            $categories = Category::lists('title', 'id'); --dans le cas ou on voudrait ne récupérer que 2 valeurs.
            $categories = Category::all();
            $view->with(compact('categories'));
        });
    }


    public function login(Request $request) {
        $title = 'Autentification';
        if ($request->isMethod('post')) {
            $this->validate($request,
                [
                    'email'    => 'required|email',
                    'password' => 'required',
                    'remember' => 'in:true'
                ]);

            $remember = !empty($request->input('remember')) ? true : false;
            if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember)) {
                return redirect()->intended('admin');
            } else {
                return back()->withInput($request->only('email', 'remember'))->with(['message' => 'Adresse email or password invalid', 'alert' => 'warning']);
            }
        }
        else {
            return view('auth.login', compact('title'));
        }
    }

    public function index()
    {
        $title = 'Autentification';
        return view('back.index', compact('title'));
    }

    public function logout() {
        Auth::logout();

        //todo Explication
        return redirect()->home(); // home() est un Alias de route
    }

}
