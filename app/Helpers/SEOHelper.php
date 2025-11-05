<?php

namespace App\Helpers;

use App\Models\Project;

class SEOHelper
{
    /**
     * Generate JSON-LD structured data for an organization
     *
     * @return string
     */
    public static function organizationSchema()
    {
        $organization = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => config('app.name'),
            'description' => 'PT. Nusuki Mega Utama adalah spesialis dalam layanan injeksi kebocoran, struktur, dan waterproofing untuk berbagai jenis proyek konstruksi.',
            'url' => config('app.url'),
            'logo' => config('app.url') . '/storage/images/logo.png', // You can change this to your actual logo
            'foundingDate' => '2020', // Update this to actual founding date
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Alamat Kantor',
                'addressLocality' => 'Kota',
                'addressRegion' => 'Daerah',
                'postalCode' => 'Kode Pos',
                'addressCountry' => 'ID'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+62-xxx-xxxx-xxxx', // Replace with actual phone
                'contactType' => 'customer service',
                'areaServed' => 'ID',
                'availableLanguage' => ['id', 'en']
            ],
            'sameAs' => [
                // Add your social media links here
            ]
        ];

        return '<script type="application/ld+json">' . json_encode($organization, JSON_UNESCAPED_SLASHES) . '</script>';
    }

    /**
     * Generate JSON-LD structured data for a project
     *
     * @param Project $project
     * @return string
     */
    public static function projectSchema(Project $project)
    {
        $projectSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Project',
            'name' => $project->title,
            'description' => $project->description ? strip_tags($project->description) : '',
            'startDate' => $project->project_date ? $project->project_date->format('Y-m-d') : '',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('projects.show', $project)
            ],
            'image' => $project->primaryImage ? asset($project->primaryImage->image_path) : null,
            'url' => route('projects.show', $project)
        ];

        if ($project->client) {
            $projectSchema['client'] = [
                '@type' => 'Organization',
                'name' => $project->client
            ];
        }

        if ($project->location) {
            $projectSchema['location'] = [
                '@type' => 'Place',
                'name' => $project->location
            ];
        }

        return '<script type="application/ld+json">' . json_encode($projectSchema, JSON_UNESCAPED_SLASHES) . '</script>';
    }

    /**
     * Generate JSON-LD for Breadcrumb
     *
     * @param array $breadcrumbs
     * @return string
     */
    public static function breadcrumbSchema($breadcrumbs = [])
    {
        if (empty($breadcrumbs)) {
            // Default breadcrumbs for homepage
            $breadcrumbs = [
                ['name' => 'Beranda', 'url' => url('/')],
                ['name' => 'Proyek', 'url' => route('projects.index')]
            ];
        }

        $breadcrumbList = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => []
        ];

        foreach ($breadcrumbs as $index => $breadcrumb) {
            $breadcrumbList['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url']
            ];
        }

        return '<script type="application/ld+json">' . json_encode($breadcrumbList, JSON_UNESCAPED_SLASHES) . '</script>';
    }
}