@extends('main')

@section('title' , '| Edit Tag')

@section('stylesheets')

   {!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')

        @can('update', $tag)
            {!! Form::model($tag , ['route' => ['tags.update' , $tag->id] , 'method' => "PUT"]) !!}

            {{ Form::label('name' , 'Title') }}
            {{ Form::text('name' , null , ['class' => 'form-control input-lg']) }}

            {{ Form::submit('Save Changes' , ['class' => 'btn btn-success btn-h1-spacing']) }}

            {!! Form::close() !!}
        @endcan


@endsection
