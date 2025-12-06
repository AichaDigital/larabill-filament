<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament;

use AichaDigital\LarabillFilament\Resources\ArticleResource;
use AichaDigital\LarabillFilament\Resources\CustomerResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class LarabillFilamentPlugin implements Plugin
{
    protected bool $hasCustomerResource = true;

    protected bool $hasArticleResource = true;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'larabill-filament';
    }

    public function register(Panel $panel): void
    {
        $resources = [];

        if ($this->hasCustomerResource()) {
            $resources[] = CustomerResource::class;
        }

        if ($this->hasArticleResource()) {
            $resources[] = ArticleResource::class;
        }

        $panel->resources($resources);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function customerResource(bool $condition = true): static
    {
        $this->hasCustomerResource = $condition;

        return $this;
    }

    public function hasCustomerResource(): bool
    {
        return $this->hasCustomerResource;
    }

    public function articleResource(bool $condition = true): static
    {
        $this->hasArticleResource = $condition;

        return $this;
    }

    public function hasArticleResource(): bool
    {
        return $this->hasArticleResource;
    }
}
