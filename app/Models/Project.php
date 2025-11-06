<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $category
 * @property string|null $client
 * @property string|null $location
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $project_date
 * @property bool $is_featured
 * @property bool $is_active
 * @property int $order
 * @property-read \Illuminate\Database\Eloquent\Collection|ProjectImage[] $images
 * @property-read ProjectImage|null $primaryImage
 */
class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'client',
        'location',
        'url',
        'project_date',
        'is_featured',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'project_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Boot the model and set up the slug generation.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($project) {
            if (! $project->isDirty('slug')) {
                $baseSlug = Str::slug($project->title);
                $slug = $baseSlug;
                $count = 1;
                
                // Check if slug already exists, and if so, append a number
                while (static::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                
                $project->slug = $slug;
            }
        });
    }

    /**
     * Get the images for the project.
     */
    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    /**
     * Get the primary image for the project.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProjectImage::class)->orderBy('order');
    }
}