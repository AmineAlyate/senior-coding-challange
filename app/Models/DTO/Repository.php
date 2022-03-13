<?php

namespace App\Models\DTO;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class Repository
{
    private string $name;
    private string $visibility;
    private string $watchers;
    private string $createdAt;
    private string $url;
    private string $contributorsUrl;
    private ?string $description;

    public function __construct(
        string $name,
        string $visibility,
        string $watchers,
        string $createdAt,
        string $url,
        string $contributorsUrl,
        ?string $description,
    ) {
        $this->name = $name;
        $this->visibility = $visibility;
        $this->watchers = $watchers;
        $this->createdAt = $createdAt;
        $this->url = $url;
        $this->contributorsUrl = $contributorsUrl;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::make($this->createdAt);
    }

    public function getWatchers(): string
    {
        return $this->watchers;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'name', ''),
            Arr::get($data, 'visibility', ''),
            Arr::get($data, 'watchers', ''),
            Arr::get($data, 'created_at', ''),
            Arr::get($data, 'url', ''),
            Arr::get($data, 'contributors_url', ''),
            Arr::get($data, 'description', ''),
        );
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getContributorsUrl(): string
    {
        return $this->contributorsUrl;
    }
}