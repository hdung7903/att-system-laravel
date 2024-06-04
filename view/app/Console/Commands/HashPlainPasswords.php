<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashPlainPasswords extends Command
{
    protected $signature = 'hash:plain-passwords';
    protected $description = 'Hash all plaintext passwords using Bcrypt';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all users with plaintext passwords
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Check if the password is not already hashed
            if (!Hash::needsRehash($user->password)) {
                // Hash the password and update it in the database
                $hashedPassword = Hash::make($user->password);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => $hashedPassword]);

                $this->info("Hashed password for user ID: {$user->id}");
            }
        }

        $this->info('All plaintext passwords have been hashed.');
    }
}

