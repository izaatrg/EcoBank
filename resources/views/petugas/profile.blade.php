@extends('layouts.petugas')

@section('page_title', 'Profil Petugas')
@section('page_subtitle', 'Kelola informasi pribadi dan kata sandi Anda.')

@section('content')
<style>
    .profile-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(18, 73, 52, 0.04);
        border: 1px solid #e2e8f0;
        max-width: 800px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.95rem;
        color: #1e293b;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
        border-color: #1b513e;
        box-shadow: 0 0 0 3px rgba(27, 81, 62, 0.1);
    }

    .btn-save {
        background-color: #1b513e;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-save:hover {
        background-color: #0f3d2e;
    }

    .profile-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 640px) {
        .profile-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-card">
    <form action="{{ route('petugas.profile.update') }}" method="POST">
        @csrf

        <div class="profile-row">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $petugas->name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $petugas->email) }}" required>
            </div>
        </div>

        <div class="profile-row">
            <div class="form-group">
                <label class="form-label">No. Telepon / HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $petugas->no_hp) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $petugas->alamat) }}">
            </div>
        </div>

        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 1.5rem 0;">

        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1e293b; margin-bottom: 1rem;">Ubah Kata Sandi (Kosongkan jika tidak ingin diubah)</h3>

        <div class="profile-row">
            <div class="form-group">
                <label class="form-label">Kata Sandi Baru</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
            </div>
        </div>

        <div style="text-align: right; margin-top: 1rem;">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
