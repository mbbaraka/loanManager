@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payments</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Annual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Payments Table</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Process New Payment
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('clients-new') }}">New Client</a>
                    <a class="dropdown-item" href="{{ route('clients-existing') }}">Existing Client</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Amount Taken</th>
                            <th>Balance</th>
                            <th>Loan Period</th>
                            <th>Date Last Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Client Name</th>
                            <th>Amount Taken</th>
                            <th>Balance</th>
                            <th>Loan Period</th>
                            <th>Date Last Payment</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->client->first_name. ' ' .$loan->client->last_name }}</td>
                            <td>UGX {{ number_format($loan->amount) }}</td>
                            <td>UGX
                                @if ($loan->payment->last() != NULL)
                                    {{ number_format($loan->payment->last()->balance) }}
                                @else
                                    {{ number_format($loan->amount) }}
                                @endif
                            </td>
                            <td>
                                @if (((intval($loan->period))/30) == 1)
                                    {{((intval($loan->period))/30)." month"}}
                                @elseif(((intval($loan->period))/30) > 1)
                                    {{((intval($loan->period))/30)." months"}}
                                @elseif ($loan->period == 7)
                                    {{ "one week" }}
                                @elseif ($loan->period == 14)
                                    {{ "two weeks" }}
                                @endif
                                <br>
                                @if ((Carbon\Carbon::now()->subDays(intval($loan->period))) > $loan->created_at)
                                    <small class="text-danger">Loan period overdue</small>
                                @endif
                            </td>
                            <td>
                                @if ($loan->payment->last() != NULL)
                                    {{ date('d M, Y', strtotime($loan->payment->last()->created_at)) }}
                                @else
                                    {{ date('d M, Y', strtotime($loan->created_at)) }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" title="View Loan Details" class="btn btn-outline-primary"><i class="fa fa-eye"></i></button>
                                    <a href="{{ route('make-payment', [$loan->client_id, $loan->loan_id]) }}" title="Make Payment Now" class="btn btn-outline-primary"><i class="fab fa-cc-amazon-pay"></i></a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        {{-- <div class="modal fade" id="delete{{ $loan->loan_id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Loan Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure about this?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="{{ route('loans-destroy', $loan->loan_id) }}" class="btn btn-primary">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
