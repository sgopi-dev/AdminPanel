@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employees</h2>

    <form method="GET" class="card p-3 mb-4 shadow-sm">

        <div class="row g-2 align-items-end">

            <div class="col-md-4">
                <label class="form-label">Search Employee</label>
                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Name or email"
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Company</label>
                <select name="company" class="form-select">
                    <option value="">All Companies</option>

                    @foreach($companies as $company)
                    <option value="{{ $company->id }}"
                        {{ request('company') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>

                    <option value="1" {{ request('status')==='1' ? 'selected':'' }}>
                        Active
                    </option>

                    <option value="0" {{ request('status')==='0' ? 'selected':'' }}>
                        Inactive
                    </option>

                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">

                <button class="btn btn-primary w-100">
                    Search
                </button>

                <a href="{{ route('employees.index') }}"
                    class="btn btn-secondary w-100">
                    Reset
                </a>

            </div>

        </div>

    </form>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th width="70">Photo</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Status</th>
                <th width="150">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($employees as $employee)
            <tr>

                <!-- PHOTO -->
                <td>
                    @if($employee->photo)
                    <img src="{{ asset('storage/'.$employee->photo) }}"
                        width="40"
                        height="40"
                        style="border-radius:50%;object-fit:cover;">
                    @else
                    <div style="
                        width:40px;
                        height:40px;
                        border-radius:50%;
                        background:#4f46e5;
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-weight:bold;">
                        {{ strtoupper(substr($employee->first_name,0,1)) }}
                    </div>
                    @endif
                </td>

                <!-- NAME -->
                <td>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </td>

                <!-- COMPANY -->
                <td>
                    {{ $employee->company->name }}
                </td>

                <!-- EMAIL -->
                <td>
                    {{ $employee->email }}
                </td>

                <!-- STATUS -->
                <td>
                    @if($employee->is_active)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>

                <!-- ACTION -->
                <td>
                    <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('employees.destroy',$employee->id) }}"
                        method="POST"
                        style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $employees->links() }}
</div>
@endsection