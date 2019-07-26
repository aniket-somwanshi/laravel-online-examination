@extends('layouts.app')

    @section('content')
    <div class="btn btn-default"><a href="\posts">GO BACK</a></div>
        <h1>Edit Post</h1>
        {!! Form::open(['action' => ['PostsController@update', $post->id],'method'=>'POST']) !!}
            <div class="form-group">
                {!! Form::label('title','Enter title') !!}
                {!! Form::text('title', $post->title, ['class'=>'form-control','placeholder'=>'Title']) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('body','Enter Body of Blog') !!}
                    {!! Form::textArea('body', $post->body, ['class'=>'form-control','placeholder'=>'Write']) !!}
                </div>
            {!! Form::hidden('_method', 'PUT') !!}
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}

    @endsection
