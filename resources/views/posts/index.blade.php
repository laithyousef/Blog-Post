@extends('main')

@section('title' , '| All Posts')

@section('content')

  <div class="row">
      <div class="col-md-10">
          <h1>All Posts</h1>
      </div>
      <div class="col-md-2">
          <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create new post</a>
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-md-12">
          <table class="table">
              <thead>
                  <th>#</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Body</th>
                  <th>Created at</th>
                  <th></th>
              </thead>

              <tbody>
                  @foreach ($posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ substr(strip_tags($post->body) , 0 , 30) }} {{ strlen(strip_tags($post->body)) > 30 ? "..." : " " }}</td>
                        <td>{{ date( 'M j , Y h:ia' , strtotime($post->created_at)) }}</td>
                        <td><a href="{{route('posts.show' , $post->id)}}" class="btn btn-default">View</a>
                            @can('update', $post)
                            <a href="{{ route('posts.edit' , $post->id) }}" class="btn btn-default">Edit</a></td>
                            @endcan
                        <td>
                            @can('delete', $post)
                            {!! Form::open(['route' => ['posts.destroy' , $post->id] , 'method' => 'DELETE']) !!}

                            {!! Form::submit('Delete' , ['class' => 'btn btn-default']) !!}

                            {!! Form::close() !!}</td>

                            @endcan

                    </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="text-center">
             {!! $posts->links(); !!}
          </div>
      </div>
  </div>

@endsection
