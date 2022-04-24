
@if (Session::has('success'))

   <div class="alert alert-success" role="alert">
       <strong></strong>  {{ Session::get('success') }}
   </div>

@endif

@if (count($errors) > 0)

   <div class="alert alert-danger" role="alert">

  @foreach ($errors->all() as $error)
    <ul>
      <strong>Errors:</strong>
      <li> {{ $error }} </li>
    </ul>
  @endforeach

  @endif

