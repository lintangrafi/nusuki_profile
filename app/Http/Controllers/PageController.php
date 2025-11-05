<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\MetaTagService;

class PageController extends Controller
{
    protected $metaTagService;

    public function __construct(MetaTagService $metaTagService)
    {
        $this->metaTagService = $metaTagService;
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $this->metaTagService
            ->setTitle('Tentang Kami - ' . config('app.name'))
            ->setDescription('Pelajari lebih lanjut tentang PT. Nusuki Mega Utama, spesialis dalam injeksi kebocoran, struktur, dan waterproofing.')
            ->setKeywords('tentang kami, nusuki mega utama, profil perusahaan, layanan konstruksi')
            ->setUrl(url()->current());

        $metaTags = $this->metaTagService->generateMetaTags();

        return view('pages.about', compact('metaTags'));
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        $this->metaTagService
            ->setTitle('Kontak Kami - ' . config('app.name'))
            ->setDescription('Hubungi PT. Nusuki Mega Utama untuk konsultasi atau informasi lebih lanjut tentang layanan kami.')
            ->setKeywords('kontak, informasi kontak, hubungi kami, nusuki mega utama')
            ->setUrl(url()->current());

        $metaTags = $this->metaTagService->generateMetaTags();

        return view('pages.contact', compact('metaTags'));
    }

    /**
     * Show the homepage.
     */
    public function home()
    {
        $this->metaTagService
            ->setTitle('Spesialis Injeksi Kebocoran & Waterproofing')
            ->setDescription('PT. Nusuki Mega Utama adalah spesialis dalam layanan injeksi kebocoran, struktur, dan waterproofing untuk berbagai jenis proyek konstruksi.')
            ->setKeywords('injeksi kebocoran, waterproofing, konstruksi, layanan struktur, nusuki mega utama')
            ->setUrl(url()->current());

        $latestProjects = \App\Models\Project::where('is_active', true)
                            ->orderBy('created_at', 'desc')
                            ->limit(3)
                            ->get();

        $services = \App\Models\Service::orderBy('created_at', 'desc')
                          ->limit(4)
                          ->get();

        $metaTags = $this->metaTagService->generateMetaTags();

        return view('home', compact('latestProjects', 'services', 'metaTags'));
    }
}
