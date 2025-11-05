
@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <header class="page-header-ui-content py-5">
        <div class="container px-4">
            <div class="text-center">
                <h1 class="fw-bold">Hubungi Kami</h1>
                <p class="lead">Kami siap membantu Anda. Kirimkan pesan kepada kami atau kunjungi kami di kantor.</p>
            </div>
        </div>
    </header>

    <!-- Contact Section (Info only) -->
    <section class="py-5" style="padding-bottom:6rem;">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Informasi Kontak</h4>
                            <ul class="list-unstyled">
                                <li class="d-flex mb-3">
                                    <i class="bi bi-geo-alt-fill text-primary fs-4 me-3"></i>
                                    <div>
                                        <strong>Alamat Pusat (Jakarta):</strong><br>
                                        JL. Raya Pos Pengumben No.1
                                    </div>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="bi bi-telephone-fill text-primary fs-4 me-3"></i>
                                    <div>
                                        <strong>Telepon (Pusat):</strong><br>
                                        <a href="tel:081212084150">0812-1208-4150</a>
                                    </div>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="bi bi-telephone-fill text-primary fs-4 me-3"></i>
                                    <div>
                                        <strong>Cabang Tangerang:</strong><br>
                                        <a href="tel:081285106668">0812-8510-6668</a> / <a href="tel:0895357856136">0895-3578-56136</a>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <i class="bi bi-envelope-fill text-primary fs-4 me-3"></i>
                                    <div>
                                        <strong>Email:</strong><br>
                                        <a href="mailto:lukmanlucan68@gmail.com">lukmanlucan68@gmail.com</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100" style="overflow:hidden;">
                        <div class="card-body p-0 d-flex flex-column">
                            <div class="ratio ratio-4x3" style="max-height:360px;">
                                <iframe
                                    src="https://www.google.com/maps?q=JL.+Raya+Pos+Pengumben+No.+1+Jakarta&output=embed"
                                    style="border:0; width:100%; height:100%; display:block;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Peta lokasi JL. Raya Pos Pengumben No.1 Jakarta"
                                ></iframe>
                            </div>
                            <div class="p-3 mt-auto">
                                <a href="https://www.google.com/maps?q=JL.+Raya+Pos+Pengumben+No.+1+Jakarta" target="_blank" rel="noopener noreferrer" class="btn btn-link">Lihat di Google Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
