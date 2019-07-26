@extends('layouts.app')
    @section('content')
    <div class="btn btn-default"><a href="\posts">GO BACK</a></div>
        <h1>Create Post</h1>
        {!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {!! Form::label('title','Enter title') !!}
                {!! Form::text('title', '', ['class'=>'form-control','placeholder'=>'Title']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('body','Enter Body of Blog') !!}
                {!! Form::textArea('body', '', ['class'=>'form-control','placeholder'=>'Write']) !!}
            </div>
            <div class="form-group">
                {!! Form::file('cover_image')!!}
            </div>
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}

    @endsection
