<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alumni;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SyncAlumniSiswaUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:alumni-siswa-users {--force : Force sync even if users already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync existing alumni and siswa records with users table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');

        $this->info('Starting sync of alumni and siswa with users table...');

        DB::beginTransaction();

        try {
            // Sync Alumni
            $this->syncAlumni($force);

            // Sync Siswa
            $this->syncSiswa($force);

            DB::commit();

            $this->info('Sync completed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error during sync: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    private function syncAlumni($force)
    {
        $this->info('Syncing Alumni...');

        $alumniWithoutUsers = Alumni::whereNull('user_id')->get();

        if ($alumniWithoutUsers->isEmpty()) {
            $this->info('All alumni already have user records.');
            return;
        }

        $this->info("Found {$alumniWithoutUsers->count()} alumni without user records.");

        $bar = $this->output->createProgressBar($alumniWithoutUsers->count());
        $bar->start();

        foreach ($alumniWithoutUsers as $alumni) {
            // Check if user already exists with same username
            $existingUser = User::where('username', $alumni->username)->first();

            if ($existingUser && !$force) {
                // Link existing user
                $alumni->update(['user_id' => $existingUser->id]);
                $this->warn("Linked alumni {$alumni->name} to existing user {$existingUser->id}");
            } else {
                // Create new user
                $user = User::create([
                    'username' => $alumni->username,
                    'password' => $alumni->password, // Use existing password
                    'role' => 'alumni',
                ]);

                $alumni->update(['user_id' => $user->id]);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Alumni sync completed.");
    }

    private function syncSiswa($force)
    {
        $this->info('Syncing Siswa...');

        $siswaWithoutUsers = Siswa::whereNull('user_id')->get();

        if ($siswaWithoutUsers->isEmpty()) {
            $this->info('All siswa already have user records.');
            return;
        }

        $this->info("Found {$siswaWithoutUsers->count()} siswa without user records.");

        $bar = $this->output->createProgressBar($siswaWithoutUsers->count());
        $bar->start();

        foreach ($siswaWithoutUsers as $siswa) {
            // Check if user already exists with same username
            $existingUser = User::where('username', $siswa->username)->first();

            if ($existingUser && !$force) {
                // Link existing user
                $siswa->update(['user_id' => $existingUser->id]);
                $this->warn("Linked siswa {$siswa->name} to existing user {$existingUser->id}");
            } else {
                // Create new user
                $user = User::create([
                    'username' => $siswa->username,
                    'password' => $siswa->password, // Use existing password
                    'role' => 'siswa',
                ]);

                $siswa->update(['user_id' => $user->id]);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Siswa sync completed.");
    }
}
