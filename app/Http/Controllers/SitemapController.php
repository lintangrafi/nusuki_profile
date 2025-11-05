<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Project;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        // Create a sitemap
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
            ->add(Url::create('/tentang-kami')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/kontak-kami')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/proyek')->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create('/layanan')->setPriority(0.9)->setChangeFrequency('weekly'));

        // Add projects to sitemap
        Project::where('is_active', true)->each(function (Project $project) use ($sitemap) {
            $sitemap->add(
                Url::create("/proyek/{$project->slug}")
                    ->setPriority(0.7)
                    ->setLastModificationDate($project->updated_at)
                    ->setChangeFrequency('monthly')
            );
        });

        // Add services to sitemap (if they have individual pages)
        Service::all()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create("/layanan/{$service->slug}")
                    ->setPriority(0.7)
                    ->setLastModificationDate($service->updated_at)
                    ->setChangeFrequency('monthly')
            );
        });

        return $sitemap->toResponse(request());
    }
}
