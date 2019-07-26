@extends('layouts.app')

    @section('content')
    <div class="btn btn-default"><a href="\posts">GO BACK</a></div>
        <h1>Post detail</h1>

                <div class="well">
                  <div class="row">
                    <div class="col-4">
                    <img width=100% height=600 src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-6">
                            <h3>{{$post->title}}</h3>
                            <h1 class="d-block">{{$post->body}}</h1>
                    </div>
                    <div class="col-2">

                    </div>
                  </div>

                </div>

    {{-- modify controls --}}

    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a class="btn btn-primary color-white" href="\posts\{{$post->id}}\edit">Edit</a>

            {!! Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST', 'class'=>'d-inline-block']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
        @endif
    @endif
@endsection
