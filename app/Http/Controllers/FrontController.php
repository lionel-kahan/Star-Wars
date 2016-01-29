<?php

namespace App\Http\Controllers;

use Mail;
use View;
use App\Tag;
use App\Product;
use App\Command;
use App\Customer;
use App\Category;
use App\CommandDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    private function getTotalPrice() {
        if (!Session::has('cart')) return 0;

        $totalPrice = 0;
        $carts = Session::get('cart');

        foreach ($carts as $key => $value) {
            $product = Product::find($key);
            $totalPrice += $product->price * $value;
        }
        return $totalPrice;
    }

    public function __construct()
    {
        View::composer('partials.nav', function($view) {
            $categories = Category::all();
            $view->with(compact('categories'));
        });
    }

    public function index() {
        $products = Product::with('tags', 'category', 'picture')
                  ->online()
                  ->paginate(10);

        $title = " Home Page";

        return view('front.index', compact('products', 'title'));
    }


    public function showProduct(Request $request, $id) {
        //todo optimize model for one result
        try {
            $product = Product::findOrFail($id);
        } catch(\Exception $e) {
            return view('front.no_product');
        }

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            $quantity = array_key_exists($product->id, $cart) ? $cart[$product->id] : 1;
        } else {
            $quantity = 1;
        }

        $title = "";

        return view('front.showProduct', compact('product', 'title', 'quantity'));
    }


    public function showProductByCategory($id, $slug='') {
        try {
            $category = Category::findOrFail($id);
            $products = $category->products()->paginate(3);
        }catch(\Exception $e) {
            return view('front.no_category');
        }
        $title = "$category->title";

        return view('front.showProductByCategory', compact('products', 'title'));
    }

    public function showProductByTag($id, $slug='') {
        try {
            $tag = Tag::findOrFail($id);
            $products = $tag->products()->paginate(3);
        }catch(\Exception $e) {
            return view('front.no_tag');
        }
        $title = "$tag->name";

        return view('front.showProductByTag', compact('products', 'title'));
    }

    public function showContact () {
        $title = 'Contact page';
        return view('front.contact', compact('title'));
    }

    public function storeContact (Request $request) {
//        //$request->all() : les données du formulaire
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|email'      , //field du formulaire =>regex, verif
//            'content' => 'required|max:200'  ,
//        ]);
//
//        //var_dump($_POST);
//        if($validator->fails())
//            return back()->withInput()->withErrors($validator);

        $this->validate($request, [
            'email'   => 'required|email'   ,
            'content' => 'required|max:255'
        ]);

        $content = $request->input('content');
        Mail::send('emails.contact', compact('content'), function($m) use($request) {
            $m->from($request->input('email'), 'Client');
            $m->to(env('EMAIL_TECH'), 'admin')->subject('Contact e-boutique');
        });

        // On peut faire un redirect('contact');
        //back() est un alias de redirect
        // with: laravel met tout dans l'objet Session Laravel $_SESSION['laravel']
        return back()->with([
            'message' => trans('app.contactSuccess'),
            'alert'   => 'success' // css pour les différentes alertes de nos messages
        ]);

        /*
         * La méthode with sur la redirection est équivalente en PHP natif au code suivant :
        session_start();
        $_SESSION[laravel]['message'] = trans('app.contactSuccess');
        $_SESSION[laravel]['alert'] = 'success';
        */
    }

    public function addCart(Request $request) {
        $this->validate($request, [
            'quantity'   => 'numeric'   ,
        ]);

        if ($request->input('quantity') != 0) {
            if ($request->session()->has('cart')) {
                $cart = $request->session()->get('cart');
                $request->session()->forget('cart');
            }

            $cart[$request->input('product_id')] = $request->input('quantity');
            $request->session()->put('cart', $cart);
        }

        return redirect('/');
    }

    Public function viewCart(Request $request) {
        if (!$request->session()->has('cart')) {
            return redirect('/');
        }

        $title = "Visualisation of your cart";
        $tabCarts = $request->session()->get('cart');


        $totalPrice = 0;
        ksort($tabCarts);
        foreach ($tabCarts as $key => $value) {
            $product = Product::find($key);
            $carts[] = [
                        'productId' => $product->id           ,
                        'name'      => $product->name         ,
                        'slug'      => $product->slug         ,
                        'price'     => $product->price        ,
                        'uri'       => $product->picture->uri ,
                        'quantity'  => $value                 ,
                      ];
            $totalPrice += $product->price * $value;
        }
        return view('front.viewCart', compact('carts', 'totalPrice', 'title'));
    }

    public function removeCart ($id) {
        if (!Session::has('cart'))  return;
        $carts = Session::get('cart');
        Session::forget('cart');
        unset($carts[$id]);
        if (count($carts))  Session::put('cart', $carts);

        $carts = Session::get('cart');

        $totalPrice = $this->getTotalPrice();
        return response()->json([
            'quantity'   => isset($carts[$id]) ? $carts[$id] : '0'     ,
            'totalPrice' => $totalPrice                                ,
            'nbProd'     => isset($carts) ? count($carts) : '0'
        ]);
    }

    public function decrementProductInCart ($id) {
        if (!Session::has('cart')) return;
        $carts = Session::get('cart');
        if (!array_key_exists($id, $carts)) return;

        if ($carts[$id] > 1) $carts[$id]--;
        else                 unset($carts[$id]);

        if (count($carts)) Session::put('cart', $carts);
        else               Session::forget('cart');

        $carts = Session::get('cart');

        $totalPrice = $this->getTotalPrice();
        return response()->json([
            'quantity'   => isset($carts[$id]) ? $carts[$id] : '0'  ,
            'totalPrice' => $totalPrice                             ,
            'nbProd'     => isset($carts) ? count($carts) : '0'
        ]);
    }

    public function incrementProductInCart ($id) {
        if (!Session::has('cart')) return;
        $carts = Session::get('cart');
        if (!array_key_exists($id, $carts)) return;

        $carts[$id]++;
        Session::put('cart', $carts);

        $carts = Session::get('cart');
        $totalPrice = $this->getTotalPrice();
        return response()->json([
            'quantity'   => $carts[$id]   ,
            'totalPrice' => $totalPrice
        ]);
    }

    Public function confirmCart(Request $request) {
        if (!$request->session()->has('cart') && !$request->session()->has('message')) {
            return back();
        }

        $title = "Confirmation of your cart";
        $tabCarts = $request->session()->get('cart');

        ksort($tabCarts);
        foreach ($tabCarts as $key => $value) {
            $product = Product::find($key);
            $carts[] = [
                        'productId' => $product->id           ,
                        'name'      => $product->name         ,
                        'slug'      => $product->slug         ,
                        'price'     => $product->price        ,
                        'uri'       => $product->picture->uri ,
                        'quantity'  => $value                 ,
                      ];
        }
        $totalPrice = $this->getTotalPrice();
        return view('front.confirmCart', compact('carts', 'totalPrice', 'title'));
    }

    public function finalizeCart(Request $request) {
        if (!$request->session()->has('cart')) {
            return back();
        }

        $carts = $request->session()->get('cart');
        $totalPrice = $this->getTotalPrice();
        $command = Command::create([
                                     'customer_id'   => Auth::user()->id   ,
                                     'commanded_at'  => NULL               ,
                                     'price'         => $totalPrice        ,
                                     'nb_product'    => count($carts)      ,
                                     'status'        => 'EN_COURS'         ,
                                   ]);

        foreach ($carts as $key => $value) {
            $product = Product::find($key);

            CommandDetail::create([
                'command_id'  => $command->id     ,
                'product_id'  => $product->id     ,
                'price'       => $product->price  ,
                'quantity'    => $value
            ]);
        }
        $request->session()->forget('cart');
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        Customer::where('user_id', Auth::user()->id)->update(['number_command' => ++$customer->number_command]);

        $title = "Confirmation of your cart";
        $message = 'Your cart has been recorded';
        $typeMessage = 'success';
        $uri = '/';
        return view('front/message', compact('title', 'message', 'typeMessage', 'uri'));
    }
}
