@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('companies.index') }}">Companies</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create Company
            </li>
        </ol>
    </nav>

    <h2>Create Company</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="text" name="website" class="form-control">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <button class="btn btn-success">Create Company</button>

    </form>

</div>

@endsection