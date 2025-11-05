@extends('layouts.admin')

@section('title', $service->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $service->title }}</h3>
        <div>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">Edit Layanan</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Layanan</h5>
                    
                    @if($service->icon)
                        <div class="mb-3">
                            <i class="{{ $service->icon }} fs-1"></i>
                        </div>
                    @endif
                    
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Nama Layanan:</th>
                            <td>{{ $service->title }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ikon:</th>
                            <td>{{ $service->icon ?: 'Tidak ada ikon' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi:</th>
                            <td>{!! nl2br(e($service->description)) !!}</td>
                        </tr>
                        <tr>
                            <th>Slug:</th>
                            <td>{{ $service->slug }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat:</th>
                            <td>{{ $service->created_at->format('F j, Y g:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate:</th>
                            <td>{{ $service->updated_at->format('F j, Y g:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">Hapus Layanan</button>
        </form>
    </div>
</div>
@endsection