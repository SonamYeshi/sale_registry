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
                                    <h1>Edit the sale</h1>
                                    <p class="text-h3">Editing will modify the block where the entry has been stored on Blockchain.</p>
                                </div>
                            </div>

                            <form onSubmit="App.updateSale(); return false">
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="cust_name"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="cid_no"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="mobile"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="cust_address"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="model"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="imei_no"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="price"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <div id="purchase_date"></div>
                                    </div>
                                </div>

                                <div id="entered_by"></div>

                                <div class="row justify-content-start">
                                    <div class="col">
                                        <div id="buttons"></div>
                                        {{-- <button class="btn btn-bt mt-4">Update</button> --}}
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
    <script>
        var user = { empID : "{{ auth()->user()->empID }}" };
    </script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/web3.min.js') }}"></script>
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/sm_fetch_specific.js') }}"></script>
@endpush
@stack('scripts')
