@extends('layouts.admin')

@section('title', $project->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $project->title }}</h3>
        <div>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Back to Projects</a>
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">Edit Project</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Project Details</h5>

                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Title:</th>
                            <td>{{ $project->title }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{!! nl2br(e($project->description)) !!}</td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>{{ $project->category ?: 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>URL:</th>
                            <td>
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Project Date:</th>
                            <td>{{ $project->project_date ? $project->project_date->format('F j, Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Featured:</th>
                            <td>{{ $project->is_featured ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Active:</th>
                            <td>{{ $project->is_active ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Order:</th>
                            <td>{{ $project->order }}</td>
                        </tr>
                        <tr>
                            <th>Created:</th>
                            <td>{{ $project->created_at->format('F j, Y g:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated:</th>
                            <td>{{ $project->updated_at->format('F j, Y g:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if($project->images->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5>Project Images</h5>
                </div>
                <div class="card-body">
                    <div id="projectImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($project->images as $index => $image)
                            <button type="button" data-bs-target="#projectImages" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($project->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset($image->image_path) }}" class="d-block w-100" alt="{{ $image->alt_text }}" style="height: 300px; object-fit: cover;">
                                <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0,0,0,0.5);">
                                    <h5>{{ $image->alt_text ?: 'Project Image' }}</h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#projectImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#projectImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p class="text-center mt-2">Total Images: {{ $project->images->count() }}</p>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body text-center">
                    <p>No images added to this project yet.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
