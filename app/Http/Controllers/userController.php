<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',

        ]);
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'role' =>request('role'),
            'password' => Hash::make(request('password')),
        ]);
        return redirect()->route('admin.index_user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($user){
            return view('admin.users.edit',['user'=>$user]);
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
        //dd(request('role'));
        $user = User::find(request('id'));
        if($user){
           $request->validate([
            //'email' => 'unique:users,email_address,'.$user->id
            'name' => 'required|string|max:255',
            'email'=> 'string|email|max:255|unique:users,email,'.$user->id,
            

        ]);
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'role' => request('role'),
            'password' => Hash::make(request('password')),
        ]);
          
        }

        return redirect()->route('admin.index_user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return back();
    }
}
