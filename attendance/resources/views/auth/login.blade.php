@extends('layouts.app')
@section('main-content')
    <div class="card">
        <span class="card-header">Login</span>
        <div class="card-body">
            @if ($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="credential" class="form-label my-2">Username or Email</label>
                <input id="credential" type="text" name="credential"
                    class="form-control @error('credential') is-invalid @enderror" value="{{ old('credential') }}" 
                    autocomplete="username" autofocus />
                @error('credential')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password" class="form-label my-2">Password</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                    autocomplete="password" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="checkbox" id="remember" name="remember" class="my-2">Remember Me </input>
                <button type="submit" class=" d-flex my-2 btn btn-primary">Login</button>
            </form>
        </div>
    </div>
@endsection
