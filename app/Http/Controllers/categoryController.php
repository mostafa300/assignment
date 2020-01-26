<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $media= $categories[0]->image;
        //dd($media);
        return view('admin.categories.index', ['categories'=> $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('title','id');
        return view('admin.categories.create',['categories'=>$categories]);
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
        ]);
        $category = Category::create([
            'title'=> request('title'),
            'description' => request('description'),
            'parent_id' => request('category') ,
        ]);
        
        if ($request->hasfile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('cat_image');
        }

        return redirect()->route('admin.index_category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if($category){
        $categories = Category::all();
        return view('admin.categories.edit',['categories'=>$categories,'category'=>$category]);
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
    public function update(Request $request )
    {
        //dd(request('id'));
        $category = Category::find(request('id'));
        if($category){
        $request->validate([
            'title' =>'required',
            'description'=>'required'
        ]);
        $category->update([
            'title'=> request('title'),
            'description' => request('description'),
            'parent_id' => request('category') ,
        ]);
        
        if ($request->hasfile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('cat_image');
        }

        return redirect()->route('admin.index_category');
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
        $category = Category::find($id);
        if ($category){
            $category->delete();
        }
        return redirect()->route('admin.index_category');
    }
}
