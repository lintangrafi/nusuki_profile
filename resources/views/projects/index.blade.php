
@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <header class="page-header-ui-content py-5">
        <div class="container px-4">
            <div class="text-center">
                <h1 class="fw-bold">Proyek Kami</h1>
                <p class="lead">Jelajahi portofolio pekerjaan yang telah kami selesaikan dengan bangga.</p>
            </div>
        </div>
    </header>

    <section class="py-5">
        <div class="container px-4">
            <div class="row gx-4 gy-4">
                @forelse ($projects as $project)
                    <div class="col-md-4">
                        <div class="card portfolio-card h-100">
                            <img src="{{ $project->images->first() ? asset($project->images->first()->image_path) : 'https://via.placeholder.com/400x300' }}" class="card-img-top" alt="{{ $project->title }}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                                <p class="card-text text-muted">{{ $project->client }}</p>
                                <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h3 class="text-muted">Belum ada proyek yang ditampilkan.</h3>
                            <p>Silakan periksa kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
@endsection
