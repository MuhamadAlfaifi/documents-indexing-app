<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateMaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'master:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create master user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (User::exists()) {
            $this->error('The command was unsuccessful!');
            $this->warn('users table is not empty.');
            throw new \Exception('create master command error.');
        }

        $input = [
            'name' => env('MASTER_NAME', 'Master User'),
            'username' => env('MASTER_USERNAME', 'master'),
            'password' => env('MASTER_PASSWORD', 'password'),
        ];

        User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email_verified_at' => now(),
            'remember_token' => \Str::random(10),
            'password' => Hash::make($input['password']),
        ]);
        
        $this->info('The command was successful!');
        $this->line('Info: check .env file for master username and password.');
        return 0;
    }
}
