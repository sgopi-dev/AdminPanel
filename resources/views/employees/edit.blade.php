@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Edit Employee</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Profile Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label>First Name *</label>
            <input type="text" name="first_name" value="{{ $employee->first_name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Last Name *</label>
            <input type="text" name="last_name" value="{{ $employee->last_name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Company *</label>

            <select name="company_id" class="form-control">

                @foreach($companies as $company)

                <option value="{{ $company->id }}"
                    {{ $employee->company_id == $company->id ? 'selected' : '' }}>

                    {{ $company->name }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $employee->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="is_active" class="form-control">

                <option value="1" {{ $employee->is_active ? 'selected':'' }}>Active</option>

                <option value="0" {{ !$employee->is_active ? 'selected':'' }}>Inactive</option>

            </select>

        </div>

        <button class="btn btn-primary">Update Employee</button>

    </form>

</div>

@endsection