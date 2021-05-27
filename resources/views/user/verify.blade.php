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
                                    <h1>Verification</h1>
                                    <p class="text-h3">Please verify for your sale product</p>
                                </div>
                            </div>
                            <form onSubmit="App.verifyData(); return false">
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="cust_cid" class="form-control" placeholder="CID" required maxlength="11">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="phone_iemi" class="form-control" placeholder="IMEI Number" required maxlength="15">
                                    </div>
                                </div>
                                <span id="verifiedSign"></span>
                                <div class="row justify-content-start">
                                    <div class="col">
                                        <button class="btn btn-bt mt-4">Verify</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/web3.min.js') }}"></script>
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/verify_vivo.js') }}"></script>
    {{-- <script src="{{ asset('js/sm_dashboard.js') }}"></script> --}}
@endpush
@stack('scripts')