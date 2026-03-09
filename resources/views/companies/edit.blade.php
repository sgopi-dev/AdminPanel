@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('companies.index') }}">Companies</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Edit Company
            </li>
        </ol>
    </nav>

    <h2>Edit Company</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $company->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="text" name="website" value="{{ $company->website }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <button class="btn btn-primary">Update Company</button>

    </form>

</div>

@endsection