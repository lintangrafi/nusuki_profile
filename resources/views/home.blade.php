
@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <header class="hero-section text-white text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Solusi Konstruksi Instalasi Kebocoran</h1>
            <p class="lead my-4">Membangun masa depan dengan keahlian, inovasi, dan integritas. Temukan bagaimana kami dapat mewujudkan proyek impian Anda.</p>
            <a href="{{ route('projects.index') }}" class="btn btn-light btn-lg me-2">Lihat Proyek</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
        </div>
    </header>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Layanan Kami</h2>
                <p class="lead text-muted">Menyediakan layanan konstruksi berkualitas tinggi dari awal hingga akhir.</p>
            </div>
            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-md-4">
                        <div class="card service-card h-100">
                            <div class="card-body">
                                @if($service->icon)
                                    <i class="{{ $service->icon }} display-4 text-primary mb-3"></i>
                                @endif
                                <h5 class="card-title fw-bold">{{ $service->title }}</h5>
                                <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="text-center">Layanan belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Recent Projects Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Proyek Terbaru</h2>
                <p class="lead text-muted">Beberapa pekerjaan terbaik dan terbaru kami.</p>
            </div>
            <div class="row g-4">
                @forelse($latestProjects as $project)
                    <div class="col-md-4">
                        <div class="card portfolio-card">
                            <img src="{{ $project->images->first() ? asset($project->images->first()->image_path) : 'https://via.placeholder.com/400x300' }}" class="card-img-top" alt="{{ $project->title }}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                                <p class="card-text text-muted">{{ $project->client }}</p>
                                <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="text-center">Proyek belum tersedia.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-lg">Lihat Semua Proyek</a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 text-white text-center" style="background-color: var(--secondary-color);">
        <div class="container">
            <h2 class="fw-bold">Siap Memulai Proyek Anda?</h2>
            <p class="lead my-4">Hubungi kami untuk konsultasi dan dapatkan penawaran terbaik untuk proyek Anda.</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Hubungi Kami</a>
        </div>
    </section>
@endsection
