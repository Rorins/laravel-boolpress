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
}
//ENDPOINT PER LE API