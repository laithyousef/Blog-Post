@extends('main')

@section('title' , '| Homepage')

@section('content')

    <div class="row">
        <div class="col-md-12">
           <div class="jumbotron">
                <h1>Welcome to my Blog!</h1>
                   <p class="lead">Thank You so much for visiting. This is my test website built with laravel. Please read my popular post!!  </p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
            </div>
        </div>
    </div> <!-- end of the Header. row -->
    <div class="row">
        <div class="col-md-8">

             @foreach ($posts as $post)

            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ substr(strip_tags($post->body), 0 , 200) }} {{ strlen(strip_tags($post->body)) > 200 ? "...." : "" }}</p>
                <a href="{{ route('blog.single' , $post->slug) }}" class="btn btn-primary">Read More </a>
            </div>

            @endforeach

            <hr>

        </div>
        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>

@endsection
