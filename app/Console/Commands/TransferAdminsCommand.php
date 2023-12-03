<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Admin;

class TransferAdminsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transfer-admins-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersToTransfer = User::where('role_type', 2)->get();

        foreach ($usersToTransfer as $user) {
            Admin::create([
                'user_id' => $user->id,
                // ... other admin attributes
            ]);
        }

        $this->info('Users transferred to admins successfully.');

    }
}
