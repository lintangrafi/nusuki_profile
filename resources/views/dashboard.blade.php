
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
            <p class="mb-4">Halo <strong>{{ Auth::user()->name }}</strong>, selamat datang di dashboard.</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Website Kami</h5>
                                    <p class="card-text">Jelajahi website kami dan lihat proyek-proyek terbaru kami.</p>
                                </div>
                                <div class="bg-primary-light p-3 rounded">
                                    <i class="fas fa-globe fa-2x"></i>
                                </div>
                            </div>
                            <a href="{{ url('/') }}" class="btn btn-light mt-2">Kunjungi Website</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Profil Anda</h5>
                                    <p class="card-text">Kelola informasi pribadi dan pengaturan akun Anda.</p>
                                </div>
                                <div class="bg-success-light p-3 rounded">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-light mt-2">Edit Profil</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Admin Panel</h5>
                                    <p class="card-text">Jika Anda memiliki akses, kelola konten website dari sini.</p>
                                </div>
                                <div class="bg-info-light p-3 rounded">
                                    <i class="fas fa-cog fa-2x"></i>
                                </div>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light mt-2">Ke Admin Panel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.2);
    }

    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.2);
    }

    .bg-info-light {
        background-color: rgba(13, 202, 240, 0.2);
    }
</style>
@endsection
