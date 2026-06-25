@extends('admin.layouts.master')

@section('title', $title ?? '')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <h3>{{ $title ?? '' }}</h3>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                        autocomplete="off">
                </div>

                @unless ($user->role === 'Super Admin')
                    <div class="mb-3">
                        <label>Divisi</label>
                        <select name="division_id" class="form-control">
                            <option value="">-- Pilih Divisi --</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endunless

                <hr>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="changePassword" name="change_password">
                    <label class="form-check-label" for="changePassword">
                        Ubah Password
                    </label>
                </div>

                <div id="passwordFields" style="display:none;">
                    <div class="mb-3">
                        <label>Password Lama</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Profil</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        document.getElementById('changePassword').addEventListener('change', function() {
            document.getElementById('passwordFields').style.display = this.checked ? 'block' : 'none';
        });
    </script>
@endpush
