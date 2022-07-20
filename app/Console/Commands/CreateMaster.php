<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\PasswordValidationRules;

class CreateMaster extends Command implements CreatesNewUsers
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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = [
            'name' => env('MASTER_USERNAME', 'master'),
            'username' => env('MASTER_USERNAME', 'master'),
            'email' => env('MASTER_EMAIL', 'master@somewhere.com'),
            'password' => env('MASTER_PASSWORD', 'password'),
        ];

        $this->create($input);
        $this->info('The command was successful!');
        $this->line('Info: check .env file for master username and password.');
    }

    /**
     * Create master user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        DB::transaction(function () use ($input) {
            return tap(User::forceCreate([
                'name' => $input['name'],
                'email' => $input['email'],
                'email_verified_at' => now(),
                'remember_token' => \Str::random(10),
                'password' => Hash::make($input['password']),
                'master' => 1,
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create master team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "master's team",
            'personal_team' => true,
        ]);

        $user->ownedTeams()->save($team);
        $user->switchTeam($team);
    }
}
