<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
//for delete img from storage
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Post::all();
        $posts= Post::orderBy('id','desc')->paginate(1);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
            //handle file upload
        if($request->hasFile('cover_image')){
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //Upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);


        }
        else{
            $fileNameToStore='noimage.jpg';
        }

        //create post variable
        $post = new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image= $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post= Post::find($id);

        //check if its the correct user wanting to edit
        //if someone types url to edit/delete someones post, this will prevent that

        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('Error','Unauthorized access');
        }
        else
        {
            return view('posts.edit')->with('post',$post);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

        $post =Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->save();

        return redirect('/posts')->with('success','Post is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::Find($id);

        //check if its the correct user wanting to edit
        //if someone types url to edit/delete someones post, this will prevent that

        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('Error','Unauthorized access');
        }
        else{

            //to delete stored image also
            if($post->cover_image != 'noimage.jpg'){
                Storage::delete('public/cover_images/'.$post->cover_image);
            }

            $post->delete();
            return redirect('/posts')->with('success','Post is removed');
        }
    }
}
