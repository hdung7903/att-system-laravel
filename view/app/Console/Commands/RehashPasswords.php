<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RehashPasswords extends Command
{
    protected $signature = 'rehash:passwords';
    protected $description = 'Rehash all passwords using Bcrypt';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            if (Hash::needsRehash($user->password)) {
                $hashedPassword = Hash::make($user->password);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => $hashedPassword]);
                $this->info("Rehashed password for user ID: {$user->id}");
            }
        }

        $this->info('All passwords have been rehashed.');
    }
}
