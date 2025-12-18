@if($hasIssues)
<x-filament::section class="bg-danger-50 dark:bg-danger-950 border-danger-300 dark:border-danger-700">
    <div class="flex items-start gap-4">
        <div class="flex-shrink-0">
            <x-heroicon-o-exclamation-triangle class="h-8 w-8 text-danger-600 dark:text-danger-400" />
        </div>
        <div class="flex-1">
            <h3 class="text-lg font-bold text-danger-800 dark:text-danger-200">
                @if($isCompanyBlocked)
                    {{ __('larabill-filament::widgets.fiscal_integrity.title_global') }}
                @else
                    {{ __('larabill-filament::widgets.fiscal_integrity.title_atomic') }}
                @endif
            </h3>

            <p class="mt-1 text-sm text-danger-700 dark:text-danger-300">
                @if($isCompanyBlocked)
                    {{ __('larabill-filament::widgets.fiscal_integrity.message_global') }}
                @else
                    {{ __('larabill-filament::widgets.fiscal_integrity.message_atomic', ['count' => count($affectedUsers)]) }}
                @endif
            </p>

            <div class="mt-3 flex flex-wrap gap-2">
                @if($isCompanyBlocked)
                    <x-filament::button
                        :href="route('filament.admin.resources.company-fiscal-configs.index')"
                        tag="a"
                        color="danger"
                        size="sm"
                    >
                        {{ __('larabill-filament::widgets.fiscal_integrity.action_resolve') }}
                    </x-filament::button>
                @endif

                @if($isUserBlocked && !$isCompanyBlocked)
                    <x-filament::button
                        :href="route('filament.admin.resources.users.index')"
                        tag="a"
                        color="danger"
                        size="sm"
                    >
                        {{ __('larabill-filament::widgets.fiscal_integrity.action_view_users') }}
                    </x-filament::button>
                @endif

                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-danger-700 dark:text-danger-300 bg-danger-100 dark:bg-danger-900 rounded">
                    {{ trans_choice('larabill-filament::widgets.fiscal_integrity.issues_count', $issuesCount, ['count' => $issuesCount]) }}
                </span>
            </div>

            @if(!empty($affectedUsers) && !$isCompanyBlocked)
                <div class="mt-3 text-xs text-danger-600 dark:text-danger-400">
                    {{ __('larabill-filament::widgets.fiscal_integrity.affected_users') }}:
                    {{ implode(', ', array_slice($affectedUsers, 0, 5)) }}
                    @if(count($affectedUsers) > 5)
                        {{ __('larabill-filament::widgets.fiscal_integrity.and_more', ['count' => count($affectedUsers) - 5]) }}
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-filament::section>
@endif
