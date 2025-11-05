<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\MetaTagService;

class ServiceController extends Controller
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
            ->setTitle('Layanan Kami - ' . config('app.name'))
            ->setDescription('Temukan layanan-layanan profesional yang kami tawarkan di PT. Nusuki Mega Utama.')
            ->setKeywords('layanan, jasa konstruksi, injeksi kebocoran, waterproofing, perbaikan struktur')
            ->setUrl(url()->current());

        $services = Service::orderBy('created_at', 'desc')->get();
        
        $metaTags = $this->metaTagService->generateMetaTags();

        return view('services.index', compact('services', 'metaTags'));
    }
}