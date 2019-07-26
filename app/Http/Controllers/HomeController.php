<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

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
        //extract only posts made by user
       // $id=auth()->user()->id;
       // $posts = Post::where('user_id', $id)->get();

       //alternate way using relation ships
       $user_id=auth()->user()->id;
       $user=User::find($user_id);
       return view('home')->with('posts',$user->posts);

    }
}
