<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Post;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $post = new Post;
        $post->title = 'mi primer Post';
        $post->excert = 'Extracto de mi primer post';
        $post->body = 'Contenido de mi primer post';
        $post->published_at = Carbon::now()->subDay(4);
        $post->category_id = 1;
        $post->save();


        $post = new Post;
        $post->title = 'mi segundo Post';
        $post->excert = 'Extracto de mi segundo post';
        $post->body = 'Contenido de mi segundo post';
        $post->published_at = Carbon::now()->subDay(3);
        $post->category_id = 2;
        $post->save();

        $post = new Post;
        $post->title = 'mi tercer Post';
        $post->excert = 'Extracto de mi tercer post';
        $post->body = 'Contenido de mi tercer post';
        $post->published_at = Carbon::now()->subDay(2);
        $post->category_id = 1;
        $post->save();

        $post = new Post;
        $post->title = 'mi 4 Post';
        $post->excert = 'Extracto de mi 4 post';
        $post->body = 'Contenido de mi 4 post';
        $post->published_at = Carbon::now()->subDay(1);
        $post->category_id = 2;
        $post->save();
    }
}
