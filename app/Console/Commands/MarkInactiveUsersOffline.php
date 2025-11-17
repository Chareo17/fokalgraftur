<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alumni;
use App\Models\Siswa;
use Carbon\Carbon;

class MarkInactiveUsersOffline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-inactive-users-offline {--minutes=30 : Minutes of inactivity before marking offline}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark users as offline if they have been inactive for a specified period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $minutes = $this->option('minutes');
        $inactiveTime = Carbon::now()->subMinutes($minutes);

        $this->info("Marking users inactive for more than {$minutes} minutes as offline...");

        // Mark inactive alumni as offline
        $alumniUpdated = Alumni::where('is_online', true)
            ->where('last_activity_at', '<', $inactiveTime)
            ->update(['is_online' => false]);

        // Mark inactive siswa as offline
        $siswaUpdated = Siswa::where('is_online', true)
            ->where('last_activity_at', '<', $inactiveTime)
            ->update(['is_online' => false]);

        $this->info("Marked {$alumniUpdated} alumni and {$siswaUpdated} siswa as offline.");
        $this->info("Command completed successfully!");

        return 0;
    }
}
