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
                                    <h1>Change Password</h1>
                                    {{-- <p class="text-h3">Change your password</p> --}}
                                </div>
                            </div>

                            <form method="POST" action="{{ route('change.password') }}" class="mt-3">
                                @csrf

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required autocomplete="new-password" value="{{ old('current_password') }}">
        
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        name="new_password" required autocomplete="new-password">
        
                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror"
                                        name="new_confirm_password" required autocomplete="new-password">

                                        @error('new_confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                            

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-bt btn-block">
                                            {{ __('Update Password') }}
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

@push('scripts')
    <script src="{{ asset('js/snackbar.js') }}"></script>
@endpush
@stack('scripts')