@extends('main')

@section('title' , '| Forget My Password')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">Reset Password</div>

            <div class="panel-body">

                {!! Form::open([ 'url' => 'auth/password/reset' ]) !!}

                    {{ Form::hidden('token' , '$token') }}
                
                    {{ Form::label('email' , 'Email Address:' , ['class' => 'form-spacing-top']) }}
                    {{ Form::email('email' , '$email' , ['class' => 'form-control']) }}

                    {{ form::label('password' , 'New Password:' , ['class' => 'form-spacing-top'] ) }}
                    {{ Form::password('password' , ['class' => 'form-control']) }}
                    
                    {{ form::label('password_confirmation' , 'Confirm New Password:' , ['class' => 'form-spacing-top'] ) }}
                    {{ Form::password('password_confirmation' , ['class' => 'form-control']) }}

                    {{ Form::submit('Reset Password' , ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection