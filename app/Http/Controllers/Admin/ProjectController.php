<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    protected $imageOptimizationService;

    public function __construct(ImageOptimizationService $imageOptimizationService)
    {
        $this->imageOptimizationService = $imageOptimizationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // Store on the public disk so files land in storage/app/public
                $path = $image->store('projects', 'public'); // returns projects/filename.jpg

                // Optimize the image (pass the relative path on the public disk)
                $this->imageOptimizationService->optimizeImage($path);

                $project->images()->create([
                    // store a public URL-friendly path (we prefix with 'storage/'),
                    // views use asset($image->image_path) to render the URL.
                    'image_path' => 'storage/' . $path,
                    'alt_text' => $request->input('image_alt_texts')[$index] ?? null,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        if ($request->hasFile('images')) {
            // Delete old images if requested
            if ($request->has('delete_images')) {
                    foreach ($request->input('delete_images') as $imageId) {
                        $image = ProjectImage::find($imageId);
                        if ($image) {
                            // Delete the actual file from the public disk
                            $filePath = ltrim(str_replace('storage/', '', $image->image_path), '/'); // projects/filename.jpg
                            Storage::disk('public')->delete($filePath);
                            $image->delete();
                        }
                    }
            }

            // Upload new images
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('projects', 'public');

                    // Optimize the image
                    $this->imageOptimizationService->optimizeImage($path);

                    $project->images()->create([
                        'image_path' => 'storage/' . $path,
                        'alt_text' => $request->input('image_alt_texts')[$index] ?? null,
                        'order' => $project->images()->count() + $index,
                    ]);
                }
        } elseif ($request->has('delete_images')) {
            // Delete images only (no new uploads)
                foreach ($request->input('delete_images') as $imageId) {
                $image = ProjectImage::find($imageId);
                if ($image) {
                    // Delete the actual file from the public disk
                    $filePath = ltrim(str_replace('storage/', '', $image->image_path), '/');
                    Storage::disk('public')->delete($filePath);
                    $image->delete();
                }
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete all associated images
        foreach ($project->images as $image) {
            // stored image_path is 'storage/projects/filename.jpg' — remove the 'storage/' prefix
            $filePath = ltrim(str_replace('storage/', '', $image->image_path), '/'); // projects/filename.jpg
            Storage::disk('public')->delete($filePath);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
