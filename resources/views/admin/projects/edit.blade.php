
@extends('layouts.admin')

@section('title', 'Edit Proyek: ' . $project->title)

@section('content')

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="images" class="form-label">Tambah Gambar Baru</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple>
                                    <div class="form-text">Pilih lebih dari satu gambar dengan menekan Ctrl/Cmd sambil memilih file</div>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="client" class="form-label">Klien</label>
                                    <input type="text" class="form-control @error('client') is-invalid @enderror" id="client" name="client" value="{{ old('client', $project->client) }}">
                                    @error('client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $project->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="project_date" class="form-label">Tanggal Proyek</label>
                                    <input type="date" class="form-control @error('project_date') is-invalid @enderror" id="project_date" name="project_date" value="{{ old('project_date', $project->project_date->format('Y-m-d')) }}">
                                    @error('project_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="mb-3">Gambar Saat Ini</h5>
                            <div class="row">
                                @if($project->images->count() > 0)
                                    @foreach ($project->images as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100">
                                                <img src="{{ asset($image->image_path) }}" class="card-img-top" alt="{{ $image->alt_text ?: $project->title }}">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                                        <label class="form-check-label small" for="delete_image_{{ $image->id }}">
                                                            Hapus Gambar
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <p class="text-muted">Belum ada gambar untuk proyek ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Perbarui Proyek</button>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
