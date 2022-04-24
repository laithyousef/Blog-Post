@extends('main')


@section('content')
            <div class="row">
                <div class="col-md-12">
                    <h1>Contact Me </h1>
                    <hr>
                    <form action="{{ url('contact') }}" method="POST">
                      @csrf
                        <div class="form-group">
                            <lable name="email">Email: </lable>
                            <input id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable name="subject">Subject: </lable>
                            <input id="subject" name="Subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable name="message">Message: </lable>
                            <textarea id="message" name="message" class="form-control" placeholder ="Type your message here...."></textarea>
                        </div>
                        <input type="submit" value="Send Message" class="btn btn-success">
                    </form>
                </div>
            </div>

@endsection            
     