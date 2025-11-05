
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="h4 mb-4">Dashboard Admin</h2>
            <p>Anda telah berhasil masuk ke akun Anda.</p>
            
            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Proyek</h5>
                                    <h3 class="mb-0">{{ \App\Models\Project::count() }}</h3>
                                    <p class="mb-0">Total Proyek</p>
                                </div>
                                <div class="bg-primary-light p-3 rounded">
                                    <i class="fas fa-project-diagram fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Layanan</h5>
                                    <h3 class="mb-0">{{ \App\Models\Service::count() }}</h3>
                                    <p class="mb-0">Total Layanan</p>
                                </div>
                                <div class="bg-success-light p-3 rounded">
                                    <i class="fas fa-cogs fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tindakan Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Proyek Baru
                                </a>
                                <a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Layanan Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Proyek Terbaru</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $latestProjects = \App\Models\Project::orderBy('created_at', 'desc')->limit(5)->get();
                            @endphp
                            
                            @if($latestProjects->count() > 0)
                                <div class="list-group list-group-flush">
                                    @foreach($latestProjects as $project)
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ Str::limit($project->title, 40) }}</h6>
                                                <small>{{ $project->created_at->diffForHumans() }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">Belum ada proyek</p>
                            @endif
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
</style>
@endsection
