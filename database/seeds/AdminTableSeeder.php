<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
