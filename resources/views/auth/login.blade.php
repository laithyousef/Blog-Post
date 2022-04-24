@extends('main')

@section('title' , '| Login-page')


@section('content')

<div class="row">
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open(['route' => 'auth.login']) !!}

                <a class="btn btn-danger btn-block" href="{{ route('login.google') }}">Login with Google</a>
                <a class="btn btn-primary btn-block" href="{{ route('login.facebook') }}">Login with Facebook</a>
                <a class="btn btn-success btn-block" href="{{ route('login.github') }}">Login with Github</a>

				{{ Form::label('email', 'Email:' , ['class' => 'form-spacing-top']) }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}

				{{ Form::label('password', "Password:") }}
				{{ Form::password('password', ['class' => 'form-control']) }}

				<br>
				{{ Form::checkbox('remember') }} {{ Form::label('remember', "Remember Me") }}

				<br>
				{{ Form::submit('Login', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

				<p class = "form-spacing-top"><a href="{{ url('auth/password/email') }}">Forget Your Password??</a></p>

			{!! Form::close() !!}
		</div>
	</div>

@endsection
