@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('msg'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('msg') }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <section class="my-5">
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <div class="row">
                                <div class="col text-center">
                                    <h1>Profile</h1>
                                    <p class="text-h3">Your profile information</p>
                                </div>
                            </div>
                            
                            <div class="card" style="width:300px">
                                <img class="rounded-circle mx-auto mt-2" width="250" style="display: block"
                                src="{{ asset('img/profile/' . Auth::user()->profile_path) }}">
                                <div class="card-body">
                                    <h3 class="card-title">{{ Auth::user()->name }}</h3>
                                    <h5 class="card-text">{{ Auth::user()->empID }}</h5>
                                    <p class="card-text">{{ Auth::user()->email }}</p>
                                    <a href="{{ route('profile_edit') }}"><button class="btn btn-bt mt-3">Edit Profile</button></a>
                                    <a href="{{ route('password') }}"><button class="btn btn-info mt-3 ml-2" style="color: white">Change Password</button></a>
                                </div>
                            </div>
                            
                            {{-- <div class="row align-items-center mt-3">
                                <div class="col text-center">
                                    <img class="rounded-circle" width="200" data-holder-rendered="true"
                                    src="{{ asset('img/profile/' . Auth::user()->profile_path) }}">
                                </div>
                            </div>

                            <div class="row align-items-center mt-4">
                                <div class="col text-center">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                            
                            <div class="row align-items-center mt-4">
                                <div class="col text-center">
                                    {{ Auth::user()->empID }}
                                </div>
                            </div>

                            <div class="row align-items-center mt-4">
                                <div class="col text-center">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                            <div class="row justify-content-start">
                                <div class="col text-center">
                                    <a href="{{ route('profile_edit') }}"><button class="btn btn-bt mt-4">Edit Profile</button></a>
                                    <a href="{{ route('password') }}"><button class="btn btn-info mt-4" style="color: white">Change Password</button></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection