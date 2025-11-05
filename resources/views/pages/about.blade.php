
@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <header class="page-header-ui-content py-5">
        <div class="container px-4">
            <div class="text-center">
                <h1 class="fw-bold">Tentang Kami</h1>
                <p class="lead">Mengenal lebih dekat siapa kami, visi, dan misi kami.</p>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="py-5">
        <div class="container px-4">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold">Profil Perusahaan</h2>
                    <p class="lead text-muted">{{ config('app.name', default: 'PT. Nusuki Mega Utama') }} adalah perusahaan konstruksi terkemuka dengan fokus pada kualitas, inovasi, dan kepuasan klien.</p>
                    <p>Dengan pengalaman bertahun-tahun, kami telah berhasil menyelesaikan berbagai proyek yang kompleks dan menantang. Tim kami terdiri dari para profesional berdedikasi yang berkomitmen untuk memberikan hasil terbaik dalam setiap pekerjaan.</p>
                    <p>Kami percaya bahwa fondasi yang kuat adalah kunci keberhasilan, baik dalam struktur bangunan maupun dalam hubungan kami dengan klien.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1581092918056-0c7c3b27646b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid rounded shadow-lg" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-5 bg-light">
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex h-100">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-eye-fill text-primary fs-1"></i>
                                </div>
                                <div class="ms-4">
                                    <h4 class="fw-bold">Visi</h4>
                                    <p class="text-muted">Menjadi perusahaan konstruksi paling terpercaya dan inovatif di Indonesia, yang dikenal karena keunggulan, integritas, dan komitmen terhadap pembangunan berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex h-100">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-bullseye text-primary fs-1"></i>
                                </div>
                                <div class="ms-4">
                                    <h4 class="fw-bold">Misi</h4>
                                    <ul class="text-muted">
                                        <li>Memberikan layanan konstruksi berkualitas tinggi yang melebihi harapan klien.</li>
                                        <li>Mengadopsi teknologi terbaru untuk efisiensi dan hasil yang superior.</li>
                                        <li>Menjaga standar keselamatan kerja tertinggi di semua proyek.</li>
                                        <li>Membangun hubungan jangka panjang dengan klien berdasarkan kepercayaan dan transparansi.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
