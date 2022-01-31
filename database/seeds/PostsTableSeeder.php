<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        //
        for($i = 0; $i < 3; $i++){
            $new_post = new Post();

            $new_post -> title = 'Post title'. ($i + 1);
            $new_post -> slug = Str::slug($new_post->title,'-');
            $new_post -> content = 'Lorem ipsum dolor sit amet, 
            consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
             magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris n
             isi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
             velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
              sunt in culpa qui officia deserunt mollit anim id est laborum.';

              $new_post ->save();
        }
    }
}
