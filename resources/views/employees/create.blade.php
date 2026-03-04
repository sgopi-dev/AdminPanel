@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Create Employee</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Profile Photo</label>
            <input type="file" id="photoInput" class="form-control">
            <input type="hidden" name="photo" id="croppedPhoto">
        </div>

        <div class="mb-3">

            <img id="preview"
                style="max-width:300px;display:none">

        </div>

        <button type="button"
            class="btn btn-primary mt-2"
            id="cropBtn"
            style="display:none">

            Crop Image

        </button>

        <div class="mb-3">
            <label>First Name *</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Last Name *</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Company *</label>
            <select name="company_id" class="form-control" required>

                <option value="">Select Company</option>

                @foreach($companies as $company)

                <option value="{{ $company->id }}">
                    {{ $company->name }}
                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-control">

                <option value="1">Active</option>
                <option value="0">Inactive</option>

            </select>
        </div>

        <button class="btn btn-success">Create Employee</button>

    </form>

</div>

@endsection
