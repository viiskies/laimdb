<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 3; $i++) { 
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email,
                'role' => 'admin',
                'password' => bcrypt('admin')
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email,
                'role' => 'editor',
                'password' => bcrypt('editor')
            ]);
        }

        for ($i=0; $i < 30; $i++) { 
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email,
                'role' => 'basic',
                'password' => bcrypt('basic')
            ]);
        }
    }
}
