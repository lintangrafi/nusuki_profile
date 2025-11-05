
@extends('layouts.public')

@section('content')
    <!-- Project Detail Section -->
    <section class="py-5">
        <div class="container px-4">
            <!-- Project Header -->
            <div class="text-center mb-5">
                <h1 class="fw-bold">{{ $project->title }}</h1>
                <p class="lead text-muted">{{ $project->client }}</p>
            </div>

            <div class="row gx-5">
                <!-- Project Carousel -->
                <div class="col-lg-8">
                    @if($project->images->count() > 0)
                        <div id="projectCarousel" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($project->images as $index => $image)
                                    <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner rounded">
                                @foreach($project->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->image_path) }}" class="d-block w-100" alt="{{ $project->title }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @else
                        <div class="text-center py-5 bg-light rounded">
                            <p>Tidak ada gambar untuk proyek ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Project Info -->
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Detail Proyek</h5>
                            <ul class="list-unstyled mt-3">
                                <li><strong>Klien:</strong> {{ $project->client }}</li>
                                <li><strong>Lokasi:</strong> {{ $project->location }}</li>
                                <li><strong>Tanggal:</strong> {{ $project->project_date->format('d F Y') }}</li>
                            </ul>
                            <hr>
                            <p>{{ $project->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Projects -->
            <div class="text-center mt-5">
                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Kembali ke Proyek</a>
            </div>
        </div>
    </section>
@endsection
