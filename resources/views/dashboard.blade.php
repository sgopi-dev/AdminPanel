@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto mt-12 mb-24 my-10 mb-20">

    <div class="flex flex-wrap justify-between  mb-20 ">

        <button type="button"
            onclick="window.location.href='{{ route('companies.create') }}'"
            class="flex items-center gap-2 px-6 py-3  rounded-lg shadow-md transition-all ">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>

            Create Company
        </button>

        <button type="button"
            onclick="window.location.href='{{ route('employees.create') }}'"
            class="flex items-center gap-2 px-6 py-3 bg-gray-500 hover:bg-black text-white font-bold rounded-lg shadow-md transition-all">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>

            Create Employee
        </button>

    </div>

    <!-- Company Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mt-20">

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="px-6 py-6 border-b border-gray-100 text-center">
            <h2 class="text-3xl font-bold text-gray-800">
                Companies List
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Company Name</th>
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
                                class="btn btn-sm btn-info">

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
        </div>

    </div>

</div>

@endsection