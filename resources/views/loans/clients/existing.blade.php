@extends('layouts.app')

@section('title', 'Existing Client')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Loans</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>

    </div>

    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Loans Table</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Process New Loan
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('clients-new') }}">New Client</a>
                    <a class="dropdown-item" href="#">Existing Client</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Occupation</th>
                            <th>NIN</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Occupation</th>
                            <th>Location</th>
                            <th>NIN</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->first_name }}</td>
                            <td>{{ $client->last_name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->occupation }}</td>
                            <td>{{ $client->location }}</td>
                            <td>{{ $client->id_number }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary" title="Edit Client profile"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-outline-primary" title="Delete client profile"><i class="fa fa-trash"></i></button>
                                    <a href="{{ route('loans-create', $client->client_id) }}" class="btn btn-outline-primary" title="Process loan"><i class="fa fa-dollar-sign"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
