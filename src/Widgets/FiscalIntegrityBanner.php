<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Widgets;

use AichaDigital\Larabill\Services\FiscalIntegrityChecker;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

/**
 * FiscalIntegrityBanner Widget
 *
 * Displays a critical alert banner when fiscal configuration integrity is compromised.
 * Shows at the top of the dashboard when there are:
 * - Multiple active CompanyFiscalConfig (global block)
 * - Multiple active UserTaxProfile for any user (atomic block)
 *
 * @see ADR-001 for architectural decisions
 */
class FiscalIntegrityBanner extends Widget
{
    /**
     * Sort order - show at the very top.
     */
    protected static ?int $sort = -100;

    /**
     * Full width banner.
     */
    protected int|string|array $columnSpan = 'full';

    /**
     * Polling interval to refresh status (30 seconds).
     */
    protected static ?string $pollingInterval = '30s';

    /**
     * The view for the widget.
     */
    protected string $view = 'larabill-filament::widgets.fiscal-integrity-banner';

    /**
     * Get the view data for the widget.
     *
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $checker = app(FiscalIntegrityChecker::class);
        $status = $checker->getStatus();

        return [
            'hasIssues' => ! $status['ok'],
            'isCompanyBlocked' => ! $status['company_ok'],
            'isUserBlocked' => ! $status['users_ok'],
            'issuesCount' => $status['issues_count'],
            'affectedUsers' => $status['affected_users'],
        ];
    }

    /**
     * Determine if the widget should be visible.
     *
     * Only show when there are integrity issues.
     */
    public static function canView(): bool
    {
        $checker = app(FiscalIntegrityChecker::class);
        $status = $checker->getStatus();

        return ! $status['ok'];
    }
}
