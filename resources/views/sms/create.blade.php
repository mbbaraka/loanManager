@extends('layouts.app')

@section('title', 'Processing Loan')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SMS Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Send SMS to Clients </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="h5 mb-0 text-gray-800 text-center">Filter Clients</h4>
                    <div class="row justify-content-between">
                        <a href="#" class="m-1 col-md-11 col-5 btn-block text-left btn btn-sm btn-primary shadow-sm">
                            All Clients
                        </a>
                        <a href="#" class="m-1 col-md-11 col-5 btn-block text-left btn btn-sm btn-primary shadow-sm">

                            New Clients
                        </a>
                        <a href="#" class="m-1 col-md-11 col-5 btn-block text-left btn btn-sm btn-primary shadow-sm">
                            Active Clients
                        </a>
                        <a href="#" class="m-1 col-md-11 col-5 btn-block text-left btn btn-sm btn-primary shadow-sm">
                            Inactive Clients
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <form class="user" method="POST" action="{{ route('sms-store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="client">Client</label>
                                     <select name="client" id="client" class="custom-select @error('client') is-invalid @enderror">
                                         <option>Select Client</option>
                                     </select>
                                        @error('client')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10">{{ old('message') }}</textarea>
                                    @error('client')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row float-right">
                            <div class="col-md-12 justify-content-between">
                                <button class="btn btn-primary" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    function calculator(){
        var balance = document.getElementById('balance').value;
        balance = balance.replace(/\D/g, '');
        var amount = document.getElementById('amount').value;
        var final_balance = document.getElementById('final_balance');
        // final_balance.value =  parseInt(balance, 10) - parseInt(amount, 10);
        final_balance.value = "UGX " + (parseInt(balance, 10) - parseInt(amount, 10)).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        // final_balance = final_balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        // final_balance.value = "UGX " + final_balance;
    }
</script>
@endsection
