@extends('layouts.app')

@section('title', 'New Client')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Client</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Registering a New Client</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="{{ route('client-store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror"
                                placeholder="Enter Client First Name..." name="first_name" value="{{ old('first_name') }}" required autocomplete="email">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror"
                                placeholder="Enter Client Last Name..." name="last_name" value="{{ old('last_name') }}" required autocomplete="email">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror"
                                placeholder="Enter Client Phone Number..." name="phone" value="{{ old('phone') }}" required autocomplete="email">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('location') is-invalid @enderror"
                                placeholder="Enter Client Location..." name="location" value="{{ old('location') }}" required autocomplete="email">
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('occupation') is-invalid @enderror"
                                placeholder="Enter Client Occupation..." name="occupation" value="{{ old('occupation') }}" required autocomplete="email">
                                @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('official_id') is-invalid @enderror"
                                placeholder="Enter Client National ID Number..." name="official_id" value="{{ old('official_id') }}" required autocomplete="email">
                                @error('official_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                </div>

                <div class="row float-right">
                    <div class="col-md-12 justify-content-between">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-primary" type="submit">Save and Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection
