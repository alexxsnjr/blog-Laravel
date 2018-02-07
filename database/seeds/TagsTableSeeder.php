<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        $tag = new Tag;
        $tag->name=('tag1');
        $tag->save();

        $tag = new Tag;
        $tag->name=('tag2');
        $tag->save();

        $tag = new Tag;
        $tag->name=('tag3');
        $tag->save();
    }
}