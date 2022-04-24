@extends('main')

@section('title' , '| View Post')

@section('content')
   <div class="row">
      <div class="col-md-8">
      <img src="{{ asset('images/' . $post->image) }}" alt="this is an image" height="400" width="700" />
         <h1>{{ $post->title }}</h1>

      <p class="lead"> {!! $post->body !!} </p>
      <p> {{ $post->category->name }} </p>
      <hr>

      <div class="tags">
         @foreach($post->tags as $tag)
         <span class="label label-default">
         {{ $tag->name }}
         </span>
         @endforeach
      </div>
      <div id="backend-comments" style="margin-top: 50px;">
         <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
         <table class="table">
            <thead>
               <tr>
                  <th>Name:</th>
                  <th>Email:</th>
                  <th>Comment</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($post->comments as $comment)
               <tr>
                  <td>{{ $comment->name }}</td>
                  <td>{{ $comment->email }}</td>
                  <td>{{ $comment->comment }}</td>
                  <td>
                    @can('update', $comment)
                        <a href="{{ route('comments.edit' , $comment->id) }}" class="btn btn-sm btn-primary"><span class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg></span>
                        </a>
                    @endcan

                    @can('delete', $comment)
                        <a href="{{ route('comments.delete' , $comment->id) }}" class="btn btn-sm btn-danger"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg></span>
                        </a>
                    @endcan

                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      </div>
      <div class="col-md-4">
         <div class="well">
         <dl class="dl-horizontal">
               <label>URL:</label>
               <p><a href="{{ route('blog.single' , $post->slug) }}">{{ route('blog.single' , $post->slug) }}</a></p>
            </dl>

            <dl class="dl-horizontal">
               <label>Category:</label>
               <p>{{ $post->category->name }}</p>
            </dl>


            <dl class="dl-horizontal">
               <label>Created At</label>
               <p>{{ date( 'M j , Y h:ia' , strtotime($post->created_at)) }}</p>
            </dl>

            <dl class="dl-horizontal">
               <label>Updated At</label>
               <p>{{  date( 'M j , Y h:ia' , strtotime($post->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
               <div class="col-sm-6">
                   @can('update', $post)
                   {!! Html::linkRoute('posts.edit' , 'Edit' , array($post->id) , array('class' =>' btn btn-primary btn-block')) !!}
                   @endcan
               </div>
               <div class="col-sm-6">

                   @can('delete', $post)
                   {!! Form::open(['route' => ['posts.destroy' , $post->id] , 'method' => 'DELETE']) !!}

                   {!! Form::submit('Delete' , ['class' => 'btn btn-danger btn-block']) !!}

                   {!! Form::close() !!}
                   @endcan
               </div>
               <div class= "col-md-12">
                <a href="{{ route('posts.index' , $post->id) }}" class="btn btn-default btn-block btn-h1-spacing">OK</a>
            </div>
            </div>

         </div>
      </div>
   </div>



@endsection
