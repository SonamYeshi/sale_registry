@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" id="salesToday"></h5>
                    <p class="card-text">Sales Today</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" id="todayRevenue"></h5>
                    <p class="card-text">Total Revenue Today</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" id="totalSales"></h5>
                    <p class="card-text">Total Sales</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" id="totalRevenue"></h5>
                    <p class="card-text">Total Revenue</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5" id="recentEntries">
        <div class="col-md-12">
            <div class="text-left">
                <h3 class="my-4 text-left">Latest Entries</h3>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/web3.min.js') }}"></script>
    <script src="{{ asset('js/date.min.js') }}"></script>
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="{{ asset('js/sm_dashboard.js') }}"></script>
@endpush
@stack('scripts')