
@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <header class="page-header-ui-content py-5">
        <div class="container px-4">
            <div class="text-center">
                <h1 class="fw-bold">Layanan Kami</h1>
                <p class="lead">Kami menawarkan berbagai layanan untuk memenuhi kebutuhan konstruksi Anda.</p>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container px-4">
            <div class="row gx-4 gy-4">
                @forelse ($services as $service)
                    <div class="col-md-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                @if($service->icon)
                                    <i class="{{ $service->icon }} display-4 text-primary mb-3"></i>
                                @endif
                                <h5 class="card-title fw-bold">{{ $service->title }}</h5>
                                <p class="card-text">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h3 class="text-muted">Belum ada layanan yang ditampilkan.</h3>
                            <p>Silakan periksa kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
