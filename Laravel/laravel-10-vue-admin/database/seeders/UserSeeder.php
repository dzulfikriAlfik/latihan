<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'     => 'Dzulfikri',
            'email'    => 'alfik@gmail.com',
            'password' => 'asdfasdf',
        ]);
        $admin->roles()->attach(Role::where('name', 'Administrator')->value('id'));

        $editor = User::factory()->create(['email' => 'editor@gmail.com']);
        $editor->roles()->attach(Role::where('name', 'Editor')->value('id'));
    }
}
