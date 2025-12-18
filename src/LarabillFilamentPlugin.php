<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament;

use AichaDigital\LarabillFilament\Resources\ArticleResource;
use AichaDigital\LarabillFilament\Widgets\FiscalIntegrityBanner;
use Filament\Contracts\Plugin;
use Filament\Panel;

/**
 * LarabillFilamentPlugin
 *
 * ADR-003: CustomerResource removed - Customer unified into User with billable_user_id
 */
class LarabillFilamentPlugin implements Plugin
{
    protected bool $hasArticleResource = true;

    protected bool $hasFiscalIntegrityBanner = true;

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
        $widgets = [];

        if ($this->hasArticleResource()) {
            $resources[] = ArticleResource::class;
        }

        if ($this->hasFiscalIntegrityBanner()) {
            $widgets[] = FiscalIntegrityBanner::class;
        }

        $panel->resources($resources);
        $panel->widgets($widgets);
    }

    public function boot(Panel $panel): void
    {
        //
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

    public function fiscalIntegrityBanner(bool $condition = true): static
    {
        $this->hasFiscalIntegrityBanner = $condition;

        return $this;
    }

    public function hasFiscalIntegrityBanner(): bool
    {
        return $this->hasFiscalIntegrityBanner;
    }
}
