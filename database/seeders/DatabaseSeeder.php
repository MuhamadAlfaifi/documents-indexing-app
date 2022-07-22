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

        \App\Models\User::factory(5)->create();
        \App\Models\Tag::factory(11)->create();
        \App\Models\Post::factory(838)->create();

        $roles = collect(['admin', 'editor']);
        
        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create([ 'name' => $role ]);
        }

        foreach (\App\Models\User::doesntHave('roles')->get() as $user) {
            $user->assignRole($roles->random());
        }
    }
}
