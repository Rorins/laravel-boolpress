<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //
    public function index(){

        // $posts = Post::All();
    //paginazione
        $posts = Post::paginate(3);

        return response()->json($posts);
    }

    //Post detail
    public function show($slug){
        //prendere post slug 

        //senza cat tags
        $post = Post::where('slug',$slug)->with(['category','tags'])->first();

        if(!$post){
            $post['not_found'] = true;
        }

        //ritorno dati json

        return response()->json($post);
    }
}
