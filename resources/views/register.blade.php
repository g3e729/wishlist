@extends('layouts.app')
@section('title', 'Register')

@section('content')
<section class="page-section portfolio">
    <div class="container">
        @include('partials.header2', ['h2' => 'Register'])

        @include('partials.alert-success')
        @include('partials.alert-warning')
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('register.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="name">Full Name</label>
                            <input class="form-control" id="name" type="name" name="name" value="{{ old('name', $name) }}" placeholder="Full Name" />
                            <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="email">Email Address</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $email) }}" placeholder="Email Address" />
                            <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="password">Password</label>
                            <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                            <p class="help-block text-danger">{{ $errors->first('password') }}</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="password_confirmation">Confirm Password</label>
                            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group text-center">
                        <button class="btn btn-primary" id="sendMessageButton" type="submit">Register</button>
                    </div>
                </form>
                <p class="m-0 p-0 mt-4 text-center">Already have an account? <a href="{{ route('login') }}">Login now</a>!</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection