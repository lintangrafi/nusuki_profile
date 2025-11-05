<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\MetaTagService;

class ProjectController extends Controller
{
    protected $metaTagService;

    public function __construct(MetaTagService $metaTagService)
    {
        $this->metaTagService = $metaTagService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->metaTagService
            ->setTitle('Portofolio Proyek - ' . config('app.name'))
            ->setDescription('Lihat portofolio lengkap proyek-proyek yang telah kami kerjakan di PT. Nusuki Mega Utama.')
            ->setKeywords('portofolio proyek, proyek selesai, contoh pekerjaan, nusuki mega utama')
            ->setUrl(url()->current());

        $projects = Project::where('is_active', true)
                        ->orderBy('order')
                        ->orderBy('created_at', 'desc')
                        ->paginate(9);
        
        $metaTags = $this->metaTagService->generateMetaTags();

        return view('projects.index', compact('projects', 'metaTags'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Load project with its images
        $project->load('images');
        
        // Set meta tags for the project
        $title = $project->title . ' - ' . config('app.name');
        $description = !empty($project->description) ? 
                      substr(strip_tags($project->description), 0, 160) . '...' : 
                      'Lihat detail proyek ' . $project->title . ' dari PT. Nusuki Mega Utama.';
        
        $this->metaTagService
            ->setTitle($title)
            ->setDescription($description)
            ->setKeywords($project->category ? $project->category . ', proyek, konstruksi' : 'proyek, konstruksi')
            ->setUrl(url()->current());

        if ($project->primaryImage) {
            $this->metaTagService->setImage(url($project->primaryImage->image_path));
        }

        $metaTags = $this->metaTagService->generateMetaTags();

        return view('projects.show', compact('project', 'metaTags'));
    }
}