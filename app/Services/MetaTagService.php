<?php

namespace App\Services;

class MetaTagService
{
    protected $metaTags = [];

    public function setTitle($title)
    {
        $this->metaTags['title'] = $title;
        return $this;
    }

    public function setDescription($description)
    {
        $this->metaTags['description'] = $description;
        return $this;
    }

    public function setKeywords($keywords)
    {
        $this->metaTags['keywords'] = $keywords;
        return $this;
    }

    public function setImage($image)
    {
        $this->metaTags['image'] = $image;
        return $this;
    }

    public function setUrl($url)
    {
        $this->metaTags['url'] = $url;
        return $this;
    }

    public function setCanonical($url)
    {
        $this->metaTags['canonical'] = $url;
        return $this;
    }

    public function setRobots($robots)
    {
        $this->metaTags['robots'] = $robots;
        return $this;
    }

    public function addCustom($name, $content)
    {
        $this->metaTags[$name] = $content;
        return $this;
    }

    public function getMetaTags()
    {
        return $this->metaTags;
    }

    public function generateMetaTags()
    {
        $html = '';

        // Title
        if (isset($this->metaTags['title'])) {
            $title = e($this->metaTags['title']);
            $html .= "<title>{$title}</title>\n";
            $html .= "<meta property=\"og:title\" content=\"{$title}\">\n";
            $html .= "<meta name=\"twitter:title\" content=\"{$title}\">\n";
        }

        // Description
        if (isset($this->metaTags['description'])) {
            $description = e($this->metaTags['description']);
            $html .= "<meta name=\"description\" content=\"{$description}\">\n";
            $html .= "<meta property=\"og:description\" content=\"{$description}\">\n";
            $html .= "<meta name=\"twitter:description\" content=\"{$description}\">\n";
        }

        // Keywords
        if (isset($this->metaTags['keywords'])) {
            $keywords = e($this->metaTags['keywords']);
            $html .= "<meta name=\"keywords\" content=\"{$keywords}\">\n";
        }

        // Image
        if (isset($this->metaTags['image'])) {
            $image = e($this->metaTags['image']);
            $html .= "<meta property=\"og:image\" content=\"{$image}\">\n";
            $html .= "<meta name=\"twitter:image\" content=\"{$image}\">\n";
        }

        // URL
        if (isset($this->metaTags['url'])) {
            $url = e($this->metaTags['url']);
            $html .= "<meta property=\"og:url\" content=\"{$url}\">\n";
        }

        // Canonical
        if (isset($this->metaTags['canonical'])) {
            $canonical = e($this->metaTags['canonical']);
            $html .= "<link rel=\"canonical\" href=\"{$canonical}\">\n";
        }

        // Robots
        if (isset($this->metaTags['robots'])) {
            $robots = e($this->metaTags['robots']);
            $html .= "<meta name=\"robots\" content=\"{$robots}\">\n";
        }

        // Custom tags
        foreach ($this->metaTags as $name => $content) {
            if (!in_array($name, ['title', 'description', 'keywords', 'image', 'url', 'canonical', 'robots'])) {
                if (is_array($content)) {
                    foreach ($content as $subName => $subContent) {
                        $html .= "<meta name=\"{$name}\" content=\"{$subContent}\">\n";
                    }
                } else {
                    $html .= "<meta name=\"{$name}\" content=\"{$content}\">\n";
                }
            }
        }

        // Default tags
        $html .= "<meta property=\"og:type\" content=\"website\">\n";
        $html .= "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";

        return $html;
    }

    public function reset()
    {
        $this->metaTags = [];
        return $this;
    }
}