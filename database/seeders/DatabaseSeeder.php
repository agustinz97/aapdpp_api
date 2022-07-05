<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Link;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'staging') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('users')->truncate();
            DB::table('articles')->truncate();
            DB::table('links')->truncate();

            Article::factory()->count(10)->create();
            Link::factory()->count(15)->create();

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'user@example.com',
                'email_verified_at' => now(),
                'role' => 2,
                'remember_token' => Str::random(10),
                'password' => bcrypt('mypass'), // password
            ]);

            User::factory()->create([
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'role' => 1,
                'remember_token' => Str::random(10),
                'password' => bcrypt('mypass'), // password

            ]);
        }

        if (DB::table('roles')->count() === 0) {
            Role::factory()->create(['name' => 'admin']);
            Role::factory()->create(['name' => 'member']);
        }
    }
}
