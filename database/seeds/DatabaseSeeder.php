<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Movie;
use App\Actor;
use App\Image;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = 1;
        $this->command->getOutput()->progressStart(200);
        for ($page; $page <= 10 ; $page++){
            $url = 'https://api.themoviedb.org/3/movie/top_rated?api_key=1e2dcbc9bfec809dc5b5af87fba9f171&page=' . $page;
            $json = json_decode(file_get_contents($url), true);
                        
            foreach($json['results'] as $movie) {
                $actors_url = 'https://api.themoviedb.org/3/movie/' . $movie['id'] . '/credits?api_key=1e2dcbc9bfec809dc5b5af87fba9f171';
                $actors_json = json_decode(file_get_contents($actors_url), true);
                
                for ($i = 0; $i < 3; $i++) {
                    if(!isset($actors_json['cast'][$i])) {
                        break;
                    }
                    $actor = $actors_json['cast'][$i];
                    $person_url = 'https://api.themoviedb.org/3/person/' . $actor['id'] . '?api_key=1e2dcbc9bfec809dc5b5af87fba9f171';
                    $person_json = json_decode(file_get_contents($person_url), true);        
                    
                    $api_id = $actor['id'];
                    if (Actor::where('api_id', $api_id)->exists()) {
                        $act_id = Actor::where('api_id', $api_id)->first()->id;
                        $actors_attached[] = $act_id;
                        continue;
                    }
                    $actor_name = $actor['name'];
                    $actor_profile_path = isset($actor['profile_path']) ? $actor['profile_path'] : '';
                    $person_birthday = isset($person_json['birthday']) && strlen($person_json['birthday']) == 10 ? $person_json['birthday'] : '0001-01-01';
                    $person_deathday = isset($person_json['deathday']) && strlen($person_json['deathday']) == 10 ? $person_json['deathday'] : null;
                    
                    $actor = Actor::create( [
                        'name' => $actor_name, 
                        'birthday' => $person_birthday, 
                        'deathday' => $person_deathday,
                        'user_id' => 1,
                        'api_id' => $api_id ] 
                    );
                    $act_id = Actor::where('api_id', $api_id)->first()->id;
                    $actors_attached[] = $act_id;

                    if ($actor_profile_path != '') {
                        $file = file_get_contents('http://image.tmdb.org/t/p/w300' . $actor_profile_path);
                        $ext = pathinfo($actor_profile_path, PATHINFO_EXTENSION);
                        $filename = md5($file);
                        Storage::disk('local')->put('public/photos/actors/' . $filename . '.' . $ext, $file);
                        $actor->images()->create(['filename' => $filename . '.' . $ext, 'user_id' => 1, 'featured' => 1]);
                    }
                }
                
                $file = file_get_contents('http://image.tmdb.org/t/p/w300' . $movie['poster_path']);
                $ext = pathinfo($movie['poster_path'], PATHINFO_EXTENSION);
                $filename = md5($file);
                Storage::disk('local')->put('public/photos/movies/' . $filename . '.' . $ext, $file);
                $movieCreate = Movie::create( [
                    'name' => $movie['title'], 
                    'category_id' => isset($movie['genre_ids'][0]) ? $movie['genre_ids'][0] : 7,
                    'user_id' => 1, 
                    'description' => $movie['overview'], 
                    'year' => substr($movie['release_date'], 0, 4),
                    'rating' => 1] 
                );
                $movieCreate->actors()->attach($actors_attached);
                $actors_attached = [];
                $movieCreate->images()->create(['filename' => $filename . '.' . $ext, 'user_id' => 1, 'featured' => 1]
                );
                $this->command->getOutput()->progressAdvance();
            };
        };
        $this->command->getOutput()->progressFinish();
    }
}
