<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alumni;

class UpdateDigitalCardAvailable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:digitalcard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set digital_card_available to true for all alumni users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updated = Alumni::query()->update(['digital_card_available' => true]);
        $this->info("Updated digital_card_available to true for {$updated} alumni users.");
        return 0;
    }
}
