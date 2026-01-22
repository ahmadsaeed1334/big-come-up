<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanExpiredSessions extends Command
{
    protected $signature = 'sessions:clean';
    protected $description = 'Clean expired sessions from database';

    public function handle()
    {
        $expired = time() - (config('session.lifetime', 120) * 60);

        DB::table('sessions')
            ->where('last_activity', '<', $expired)
            ->delete();

        $this->info('Expired sessions cleaned successfully.');
    }
}
