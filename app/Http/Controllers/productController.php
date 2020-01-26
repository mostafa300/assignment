<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Products;
use Auth;
class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products = Products::all();
        //$media= $Products[4]->image;
        //dd($media);
        return view ('admin.products.index',['Products'=>$Products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('title','id');
        return view ('admin.products.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' =>'required',
            'price' =>'required',
            'slug'=>'required|unique:products',
            'description'=>'required'
        ]);
        $createby = Auth::user()->email;
        //dd($createby);
        $Products = Products::create([
            'title'=> request('title'),
            'slug'=>request('slug'),
            'price'=>request('price'),
            'description' =>request('description'),
            'created_by'=> $createby,

        ]);

        $Products->categories()->sync($request->input('categories', []));
        //dd('sd');
        if ($request->hasfile('image')){
            foreach($request->file('image') as $image){
                $Products->addMedia($image)->toMediaCollection('pro_image');
            }
         }
         return redirect()->route('admin.index_product');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all()->pluck('title','id');
        $products = Products::find($id);
        if ($products){
            return view('admin.products.edit',['products'=>$products,'categories'=>$categories]);
        }
        else return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Products = Products::find(request('id')) ;
        if($Products){
        $request->validate([
            //'email' => 'unique:users,email_address,'.$user->id
            'title' =>'required',
            'price' =>'required',
            'slug'=>'unique:products,slug,'.$Products->id,
            'description'=>'required'
        ]);
        $createby = Auth::user()->email;
        //dd($createby);
        $Products->update([
            'title'=> request('title'),
            'slug'=>request('slug'),
            'price'=>request('price'),
            'description' =>request('description'),
            'created_by'=> $createby,

        ]);
        $Products->categories()->sync($request->input('categories', []));
        if ($request->hasfile('image')){
            foreach($request->file('image') as $image){
                $Products->addMedia($image)->toMediaCollection('pro_image');
            }
         }
        return redirect()->route('admin.index_product');
        }
        else return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        if($products){
            $products->delete();
        }
        return redirect()->route('admin.index_product');
    }
}
