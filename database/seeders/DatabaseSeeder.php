<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        
        collect([
            ['admin', 'Administrator users can perform any action.'],
            ['editor', 'Editor users have the ability to read, create.'],
        ])->each(function ($x) {
            [$role, $description] = $x;

            \Spatie\Permission\Models\Role::create([ 
                'name' => $role,
                'description' => $description,
            ]);
        });
        \App\Models\User::factory(7)->create();
        \App\Models\Tag::factory(6)->create();
        \App\Models\Post::factory()
                ->count(10000)
                ->state(new Sequence(
                    fn ($sequence) => ['user_id' => \App\Models\User::get()->except(1)->shuffle()->random()->id],
                ))
                ->create();

        // add roles
        \App\Models\User::all()->except(1)->each(function ($user) {
            $role = \Spatie\Permission\Models\Role::all()->shuffle()->random();
            
            $user->assignRole($role);
        });

        // add tags
        \App\Models\Post::get()->each(function ($post) {
            $tag = \App\Models\Tag::get()->shuffle()->random();

            $post->tags()->attach($tag->id);
        });
    }
}
