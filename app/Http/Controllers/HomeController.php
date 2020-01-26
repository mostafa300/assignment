<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Products;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function front()
    {
        $categories = Category::all();
        $products = Products::all();
        //dd($products[0]->image);
        return view('front',['categories'=>$categories,'products'=>$products]);
    }
    public function search (request $request) 
    {
        $categories = Category::all();
        if (request('Search') == null)
        {
            return back();
        }
        else{
            $name = request('Search');
            $products = Products::where('title','=',$name)->get();
            if (count($products) !=0 ){
                return view('front',['products'=>$products,'categories'=>$categories]);
            }
            else return back();
        }
    }
}
