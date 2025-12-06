<?php

namespace AichaDigital\LarabillFilament\Commands;

use Illuminate\Console\Command;

class LarabillFilamentCommand extends Command
{
    public $signature = 'larabill-filament';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
