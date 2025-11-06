<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
// Use the Image manager directly when available. Avoid hard dependency on the Facade so
// the service can fail gracefully if the package or extensions are not present.
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image as ImageFacade;

class ImageOptimizationService
{
    /**
     * Optimize an image file
     *
     * @param string $filePath Path to the image file to optimize
     * @param int $quality Quality percentage for optimization (1-100)
     * @return bool Whether the optimization was successful
     */
    public function optimizeImage($filePath, $quality = 80)
    {
        try {
            // Determine image handler
            if (class_exists('\Intervention\Image\Facades\Image')) {
                $image = ImageFacade::make(Storage::disk('public')->path($filePath));
            } elseif (class_exists(ImageManager::class)) {
                $manager = new ImageManager(extension_loaded('imagick') ? 'imagick' : 'gd');
                $image = $manager->make(Storage::disk('public')->path($filePath));
            } else {
                // No image library available; log and return false so upload can continue.
                Log::warning('ImageOptimizationService: Intervention Image package not available. Skipping optimization for ' . $filePath);
                return false;
            }

            // Resize the image if it's too large
            if ($image->width() > 1920) {
                $image->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            // Save the optimized image to the public disk path
            $image->save(Storage::disk('public')->path($filePath), $quality);

            return true;
        } catch (\Throwable $e) {
            // Catch Throwable to include PHP Errors (like Class not found) and ensure
            // the upload flow doesn't abort - we log and return false so the controller
            // can continue saving the DB record.
            Log::error('Error optimizing image: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create a responsive image with different sizes
     *
     * @param string $originalPath Path to the original image
     * @return array Array of paths for different image sizes
     */
    public function createResponsiveImages($originalPath, $sizes = [480, 768, 1024, 1920])
    {
        $optimizedPaths = [];

        try {
            // Determine image handler
            if (class_exists('\Intervention\Image\Facades\Image')) {
                $originalImage = ImageFacade::make(Storage::disk('public')->path($originalPath));
            } elseif (class_exists(ImageManager::class)) {
                $manager = new ImageManager(extension_loaded('imagick') ? 'imagick' : 'gd');
                $originalImage = $manager->make(Storage::disk('public')->path($originalPath));
            } else {
                Log::warning('ImageOptimizationService: Intervention Image package not available. Skipping responsive image creation for ' . $originalPath);
                return $optimizedPaths;
            }

            foreach ($sizes as $size) {
                // Create filename for this size
                $pathInfo = pathinfo($originalPath);
                $optimizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-' . $size . '.' . $pathInfo['extension'];

                // Resize the image
                $resizedImage = clone $originalImage;
                $resizedImage->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Save the resized image to the public disk path
                $resizedImage->save(Storage::disk('public')->path($optimizedPath), 80);

                $optimizedPaths[] = $optimizedPath;
            }

            return $optimizedPaths;
        } catch (\Exception $e) {
            Log::error('Error creating responsive images: ' . $e->getMessage());
            return $optimizedPaths;
        }
    }

    /**
     * Generate HTML for a responsive image with srcset
     *
     * @param string $originalPath Path to the original image
     * @param string $altText Alt text for the image
     * @param string $class Optional CSS classes
     * @return string HTML string for the responsive image
     */
    public function generateResponsiveImage($originalPath, $altText, $class = '', $fallbackWidth = 800)
    {
        $pathInfo = pathinfo($originalPath);
        $baseName = $pathInfo['dirname'] . '/' . $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        $sizes = [
            ['width' => 480, 'descriptor' => '480w'],
            ['width' => 768, 'descriptor' => '768w'],
            ['width' => 1024, 'descriptor' => '1024w'],
            ['width' => 1920, 'descriptor' => '1920w'],
        ];

        $srcsetParts = [];
        $hasResponsiveImages = false;

            foreach ($sizes as $size) {
                $responsiveImagePath = $baseName . '-' . $size['width'] . '.' . $extension;

                // Check if the responsive image exists on the public disk
                if (Storage::disk('public')->exists($responsiveImagePath)) {
                    // public URL is /storage/<path>
                    $srcsetParts[] = asset('storage/' . $responsiveImagePath) . ' ' . $size['descriptor'];
                    $hasResponsiveImages = true;
                }
            }

            // Public URL for the original image
            $src = asset('storage/' . $originalPath);

            if ($hasResponsiveImages) {
                $srcset = implode(', ', $srcsetParts);
                return "<img src=\"{$src}\" srcset=\"{$srcset}\" sizes=\"100vw\" alt=\"{$altText}\" class=\"{$class}\" loading=\"lazy\">";
            } else {
                // If no responsive images exist, return a simple img tag that loads the original
                return "<img src=\"{$src}\" alt=\"{$altText}\" class=\"{$class}\" width=\"{$fallbackWidth}\" loading=\"lazy\">";
            }
    }
}
