@extends('layouts.app')
@section('title', 'Wonderful Time Of The Year!')

@section('content')
<section class="page-section portfolio">
    <div class="container">
        @include('partials.header2', ['h2' => 'Login'])
        
        @include('partials.alert-success')
        @include('partials.alert-warning')

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="email">Email Address</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email', session('email')) }}" placeholder="Email Address" />
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
                    <br />
                    <div class="form-group text-center"><button class="btn btn-primary" id="sendMessageButton" type="submit">Login</button></div>
                </form>
                <p class="m-0 p-0 mt-4 text-center">No account yet? <a href="{{ route('register.show') }}">Register now</a>!</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection