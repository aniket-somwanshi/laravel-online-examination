@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Your Blogs</h1>
                    <table class="table table-stripped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                            <td>{{$post->title}}</td>
                            <td><a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a></td>
                            <td> {!! Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST', 'class'=>'d-inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}</td>
                            </tr>
                        @endforeach
                    <table>
                    <a href="/posts/create" class="btn btn-primary">Make a Blog</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
