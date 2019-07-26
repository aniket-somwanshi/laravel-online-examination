@extends('layouts.app')
    @section('content')
        <h1>Posts</h1>
        @if(count($posts)>0)
            @foreach ($posts as $post)
                <div class="well">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}></a></h3>
                <h3>Written by {{$post->user->name}}</h3>
                </div>
            @endforeach
            {{$posts->links()}}
        @endif
    @endsection
