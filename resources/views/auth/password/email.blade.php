@extends('main')

@section('title' , '| Forget My Password')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">Reset Password</div>

            <div class="panel-body">

            @if (session('status'))

            <div class="alert alert-success">
                {{ Session('status') }}
            </div>

            @endif

                {!! Form::open([ 'url' => 'auth/password/reset' ]) !!}
                
                    {{ Form::label('email' , 'Email Address:') }}
                    {{ Form::email('email' , null , ['class' => 'form-control']) }}

                    {{ Form::submit('Reset Password' , ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection