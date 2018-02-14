<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 10; $i++) { 
            DB::table('categories')->insert([
                'name' => $faker->streetName,
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'user_id' => $i,
            ]);
        }
    }
}
