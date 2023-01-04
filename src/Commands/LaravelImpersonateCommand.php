<?php

namespace Pinetcodev\LaravelImpersonate\Commands;

use Illuminate\Console\Command;

class LaravelImpersonateCommand extends Command
{
    public $signature = 'laravel-impersonate';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
