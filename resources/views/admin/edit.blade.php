@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}
                    <img src="{{ asset('img/blocks.png') }}" class="ml-2" width="70">
                </div>

                <div class="card-body">
                    <form method="POST" action="/manage_users/{{ $user->id }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emp" class="col-md-4 col-form-label text-md-right">{{ __('Employee ID') }}</label>

                            <div class="col-md-6">
                                <input id="emp" type="text" class="form-control @error('emp') is-invalid @enderror" name="emp"
                                value="{{ $user->empID }}" required autocomplete="name" style="text-transform:uppercase" autofocus>

                                @error('emp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('BT E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="ml-3"></div>
                                <img src="{{ asset('img/user.png') }}" width="40">
                                <input type="radio" class="col-md-1" name="roletype" value="user" 
                                @if ($user->hasRole('user'))
                                    checked
                                @endif>User
                            
                            <div class="ml-5"></div> 
                                <img src="{{ asset('img/admin.png') }}" width="40">
                                <input type="radio" class="col-md-1" name="roletype" value="admin" 
                                @if ($user->hasRole('admin'))
                                    checked
                                @endif>Admin
                        </div><hr>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-bt">
                                    {{ __('Update User') }}
                                </button>

                                <a href="/manage_users" type="button" class="btn btn-danger ml-2">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection