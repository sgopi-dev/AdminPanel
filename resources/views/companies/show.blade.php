@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
            <li class="breadcrumb-item active">{{ $company->name }}</li>
        </ol>
    </nav>

    <!-- Company Info Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <!-- Company Logo -->
                @if($company->logo)
                <img src="{{ asset('storage/'.$company->logo) }}"
                    width="100"
                    height="100"
                    class="rounded-circle me-3"
                    style="object-fit:cover;">
                @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                    style="width:100px; height:100px; font-size:36px; font-weight:bold;">
                    {{ strtoupper(substr($company->name,0,1)) }}
                </div>
                @endif

                <!-- Company Name and Employees Count -->
                <div>
                    <h2 class="mb-1">{{ $company->name }}</h2>
                    <p class="mb-0 text-muted">{{ $company->employees()->count() }} Employees</p>
                </div>
            </div>

            <hr>

            <!-- Company Details -->
            <div class="row g-3">
                @if($company->email)
                <div class="col-md-6">
                    <strong>Email:</strong>
                    <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                </div>
                @endif

                @if($company->website)
                <div class="col-md-6">
                    <strong>Website:</strong>
                    <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                </div>
                @endif

                @if($company->phone)
                <div class="col-md-6">
                    <strong>Phone:</strong>
                    <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a>
                </div>
                @endif

                @if($company->address)
                <div class="col-md-6">
                    <strong>Address:</strong>
                    {{ $company->address }}
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">
                    Edit
                </a>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                    Back
                </a>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                    Add Employee
                </a>
            </div>
        </div>
    </div>

    <!-- Employee Search Form -->
    <form method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Search Employee</label>
                <input type="text" name="search" class="form-control" placeholder="Name or email" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="1" {{ request('status')==='1' ? 'selected':'' }}>Active</option>
                    <option value="0" {{ request('status')==='0' ? 'selected':'' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-100">Search</button>
                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </div>
    </form>

    <!-- Employees Table -->
    <div class="card shadow-sm">
        <div class="card-header"><strong>Employees</strong></div>
        <div class="card-body">
            @if($employees->count())
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th> <!-- New column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            @if($employee->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $employees->links() }}
            @else
            <p class="text-muted">No employees found for this company.</p>
            @endif
        </div>
    </div>
</div>
@endsection