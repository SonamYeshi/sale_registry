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
                                    <h1>Register a sale</h1>
                                    <p class="text-h3">Each registered sale will be added to blockchain network</p>
                                </div>
                            </div>

                            <form onSubmit="App.registerSale(); return false">
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="cust_name" class="form-control" placeholder="Customer Name" required>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="cid_no" class="form-control" placeholder="CID Number" required maxlength="11">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" maxlength="8">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <textarea name="cust_address" class="form-control" rows="2" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="model" class="form-control" placeholder="Vivo Model">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="imei_no" class="form-control" placeholder="IMEI Number" required maxlength="15">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="price" class="form-control" placeholder="Price (in Nu.)">
                                    </div>
                                </div>

                                {{-- <div class="row align-items-center mt-4">
                                    <div class="col">
                                        Payment Method : 
                                        <div class="form-check-inline">
                                            <div class="form-check ml-1">
                                                <input class="form-check-input" type="radio" name="pay" id="radio1" checked>
                                                <label class="form-check-label" for="radio1">Cash</label>
                                            </div>
                                            <div class="form-check ml-1">
                                                <input class="form-check-input" type="radio" name="pay" id="radio2">
                                                <label class="form-check-label" for="radio2">Mobile Payment</label>
                                            </div>
                                            <div class="form-check ml-1">
                                                <input class="form-check-input" type="radio" name="pay" id="radio3">
                                                <label class="form-check-label" for="radio3">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <input type="text" name="purchase_date" class="form-control datepicker" placeholder="Purchased Date" autocomplete="off">
                                    </div>
                                </div>

                                <input type="hidden" name="entered_by" value="{{ Auth()->user()->empID }}">
                                
                                <div class="row justify-content-start">
                                    <div class="col">
                                        <button class="btn btn-bt mt-4">Submit</button>
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

<script>
    $('.datepicker').datepicker({
        dateFormat:'dd/mm/yy',
        maxDate: new Date
    });
</script>

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/web3.min.js') }}"></script>
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/sm_register.js') }}"></script>
@endpush
@stack('scripts')
