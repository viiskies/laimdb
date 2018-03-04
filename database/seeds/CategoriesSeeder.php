<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=1e2dcbc9bfec809dc5b5af87fba9f171';
        $json = json_decode(file_get_contents($url), true);
        
        $category = Category::create( [ 'user_id' => 1, 'name' => 'Undefined', 'description' => 'Nada', 'id' => 7 ] );

        foreach($json['genres'] as $genre) {
            $category = Category::create( [ 'user_id' => 1, 'name' => $genre['name'], 'description' => 'blank', 'id' => $genre['id'] ] );
        }
    }
}
