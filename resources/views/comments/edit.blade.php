@extends('main')

@section('title' , '| Edit Comments')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Comment</h1>

            {{ Form::model($comment , ['route' => ['comments.update' , $comment->id] , 'method' => 'PUT' ]) }}
                
            {{ Form::label('name' , 'Name:') }}
            {{ Form::text('name' , null , ['class' => 'form-control' , 'disabled' => '']) }}

            {{ Form::label('email' , 'Email:') }}
            {{ Form::text('email' , null , ['class' => 'form-control' , 'disabled' => '']) }}

            {{ Form::label('comment' , 'Comment:') }}
            {{ Form::textarea('comment' , null , ['class' => 'form-control']) }}

            {{ Form::submit('Update Comment' , ['class' => 'btn btn-primary btn-block  btn-h1-spacing' ]) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection