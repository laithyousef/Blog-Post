@extends('main')


@section('title' , "| $tag->name Tag")


@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1> {{ $tag->name }} Tag <small> {{$tag->posts()->count()}}  Posts </small> </h1>
        </div>
        @can('update', $tag)
            <div class="col-md-2 ">
                <a href="{{ route('tags.edit' , $tag->id) }}" class="btn b btn-primary btn-block pull-right" style="margin-top:20px"> Edit </a>
            </div>
        @endcan
        
        @can('delete', $tag)
            <div class="col-md-2  ">
                {{ Form::open(['route' => ['tags.destroy' , $tag->id] , 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete' , ['class'  => 'btn btn-danger btn-block' , 'style' => 'margin-top:20px'] ) }}
                {{ Form::close() }}
            </div>
        @endcan
        
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Tags</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tag->posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td> {{ $post->title }} </td>
                        <td>@foreach ($post->tags as $tag)
                                <span class="label label-default"> {{ $tag->name }} </span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('posts.show' , $post->id) }}" class="btn btn-default btn-xs">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
