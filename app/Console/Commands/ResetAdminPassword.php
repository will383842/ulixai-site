<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ResetAdminPassword extends Command
{
    protected $signature   = 'admin:reset-password {email} {password}';
    protected $description = 'Reset admin password and ensure account is active';

    public function handle(): int
    {
        $email    = $this->argument('email');
        $password = $this->argument('password');

        $updated = DB::table('users')
            ->where('email', $email)
            ->update([
                'password'   => Hash::make($password),
                'status'     => 'active',
                'user_role'  => 'super_admin',
                'deleted_at' => null,
                'updated_at' => now(),
            ]);

        if ($updated === 0) {
            // User doesn't exist yet — create it
            DB::table('users')->insert([
                'name'              => 'Williams Admin',
                'email'             => $email,
                'password'          => Hash::make($password),
                'status'            => 'active',
                'user_role'         => 'super_admin',
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
            $this->info("✅ Admin créé : {$email}");
        } else {
            $this->info("✅ Mot de passe mis à jour pour : {$email}");
        }

        return Command::SUCCESS;
    }
}
