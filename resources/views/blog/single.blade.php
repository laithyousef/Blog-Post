@extends('main')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title' , "| $titleTag")


@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <img src="{{ asset('images/' . $post->image) }}" alt="" height="400" width="800" />
            <h2>{{ $post->title }}</h2>
            <p>{!! $post->body !!}</p>
            <hr>
            <p>Posted In: {{ $post->category->name }}</p>
            <hr>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="comments-title"> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="18"  fill="currentColor" class="bi bi-chat-left-heart-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                </svg> {{ $post->comments->count() }} <strong>Comments</strong> </h3>
            @foreach($post->comments as $comment)
               <div class="comment">
                   <div class="author-info">
                       <img src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=mm" }}"  alt="" class="author-image">

                       <div class="author-name">
                       <h4>   {{ $comment->name }} </h4>
                       <p class="author-time">{{ date('F nS, Y - g:iA' , strtotime( $comment->created_at ))  }}</p>
                       </div>
                 </div>

                 <div class="comment-content">
                       <p> {{ $comment->comment }} </p>
                 </div>

               </div>
            @endforeach
        </div>
    </div>
    <div class="row">
            <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px ;">
            {{ Form::open(['route' => ['comments.store' , $post->id] , 'method' => 'POST'])  }}
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name' , 'Name:') }}
                    {{ Form::text('name' , null , ['class' => 'form-control'] ) }}
                </div>

                <div class="col-md-6">
                    {{ Form::label('email' , 'Email:') }}
                    {{ Form::text('email' , null , ['class' => 'form-control']) }}
                </div>
          
              
                <div class="col-md-12">

                    {{ Form::label('comment' , 'Comment:') }}
                    {{ Form::textarea('comment' , null , ['class' => 'form-control' , 'rows' => '5']) }}

                    {{ Form::submit('Create New Comment' , ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
              </div>
              {{ Form::close() }}  
              </div>
            </div>
        </div>

@endsection