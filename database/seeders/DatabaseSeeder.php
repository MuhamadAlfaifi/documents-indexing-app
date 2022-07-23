<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        \Artisan::call('master:install');

        \App\Models\User::factory(14)->create();
        \App\Models\Tag::factory(25)->create();
        \App\Models\Post::factory(2729)->create();

        $roles = collect([
            ['admin', 'Administrator users can perform any action.'],
            ['editor', 'Editor users have the ability to read, create, and update.'],
        ]);
        
        foreach ($roles as [$role, $description]) {
            \Spatie\Permission\Models\Role::create([ 
                'name' => $role,
                'description' => $description,
            ]);
        }

        foreach (\App\Models\User::all()->except(1) as $user) {
            $user->assignRole($roles->random()[0]);
        }
    }
}
