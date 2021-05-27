@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <section class="my-5">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="row">
                                <div class="col text-center">
                                    <h1>Edit Profile</h1>
                                    <p class="text-h3">Edit your profile information</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('profile_update') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row align-items-center mt-3">
                                    <div class="col text-center">
                                        <img class="rounded-circle" width="200" data-holder-rendered="true"
                                        src="{{ asset('img/profile/' . Auth::user()->profile_path) }}">
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col mt-4">
                                        <label>Upload Profile Image</label>
                                        <input type="file" name="profile_img" class="form-control @error('profile_img') is-invalid @enderror" >

                                        @error('profile_img')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ Auth::user()->name }}" required autocomplete="name">
        
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
                                        <input id="emp" type="text" class="form-control @error('emp') is-invalid @enderror"
                                        name="emp" value="{{ Auth::user()->empID }}" required autocomplete="name" style="text-transform:uppercase">
        
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
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                            

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-bt btn-block">
                                            {{ __('Save Changes') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="form-group row mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('profile') }}" style="text-decoration: none">
                                        <button type="submit" class="btn btn-danger btn-block">{{ __('Cancel') }}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection