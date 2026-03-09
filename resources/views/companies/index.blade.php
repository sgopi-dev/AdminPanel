@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Companies
            </li>
        </ol>
    </nav>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>Companies</h2>

        <a href="{{ route('companies.create') }}" class="btn btn-primary">
            + Create Company
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <table class="table table-bordered table-hover">

        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Employees</th>
                <th width="160">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($companies as $company)

            <tr>

                <!-- Logo -->
                <td>

                    @if($company->logo)

                    <img src="{{ asset('storage/'.$company->logo) }}"
                        width="40"
                        height="40"
                        style="border-radius:50%; object-fit:cover">

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
                        font-weight:bold">

                        {{ strtoupper(substr($company->name,0,1)) }}

                    </div>

                    @endif

                </td>

                <!-- Name -->
                <td>{{ $company->name }}</td>

                <!-- Employees -->
                <td>
                    {{ $company->employees->count() }}
                </td>

                <!-- Actions -->
                <td>

                    <a href="{{ route('companies.show', $company->id) }}"
                        class="btn btn-sm btn-warning">
                        View
                    </a>

                    <form action="{{ route('companies.destroy', $company->id) }}"
                        method="POST"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this company?')">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="6" style="text-align:center">
                    No companies found
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>


    <div style="margin-top:20px">
        {{ $companies->links() }}
    </div>

</div>

@endsection