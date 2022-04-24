@extends('main')

@section('title' , '| Creat new post ')

@section('stylesheets')

   {!! Html::style('css/parsley.css') !!}
   {!! Html::style('css/select2.min.css') !!}
   <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

   <script>
        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            plugins: 'advlist link image lists' ,
            a_plugin_option: false,
            a_configuration_option: 400
        });
   </script>

@endsection


@section('content')

  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <h1>Create New Post</h1>
          <hr>
          {!! Form::open(['route' => 'posts.store' , 'data-parsley-validate' , 'files' => 'true' ]) !!}

          {{ Form::label('title' , 'Title') }}
          {{ Form::text('title' , null ,
             array('class' => 'form-control' , 'required' => '' , 'maxlength' => '255' , 'minlength' => '6')) }}

          {{ Form::label('slug' , 'Slug') }}
          {{ Form::text('slug' , null , ['class' => 'form-control' , 'required' => '' , 'maxlength' => '255' , 'minlength' => '5']) }}

          {{ Form::label('category_id' , 'Category') }}
          <select name="category_id" class="form-control">
          @foreach($categories as $category)
             <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
          </select>

          {{ Form::label('tags' , 'Tags:') }}
            <select name="tags[]" class="form-control select2-multi "  multiple="multiple">
                @foreach( $tags as $tag )
                    <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                @endforeach
            </select>

            {{ Form::label('featured_image' ,' Upload Featured Image:' , ['class' => 'form-spacing-top']) }}
            {{ Form::file('featured_image') }}

          {{ Form::label('body' , 'Post Body' , ['class' => 'form-spacing-top ']) }}
          {{ Form::textarea('body' , null , array('class' => 'form-control ')) }}

          {{ Form::submit('Creat Post' , array('class' => 'btn btn-success btn-lg btn-block' , 'style' => 'margin-top:20px;'))}}

          {!! Form::close() !!}
      </div>
  </div>

@endsection

@section('scripts')

   {!! Html::script('js/parsley.min.js') !!}
   {!! Html::script('js/select2.min.js') !!}

   <script type="text/javascript">
       $('.select2-multi').select2();

   </script>


@endsection



