<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts= Post::all();

        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDATION
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();

        //NUOVO POST POST
        $new_post = new Post();

        //GEN SLUG UNIVOCO
        $slug = Str::slug($data['title'],'-');
        $count = 1;
        $base_slug = $slug;

        //CICLO SE HO TROVATO POST CON SLUG ATTUALE
        while(Post::where('slug', $slug)->first()){
            //Gen. nuovo slug con contatore
            $slug .= $base_slug . '-'.$count;
            $count++;
        }
        $data['slug'] = $slug;

        $new_post->fill($data);
        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post->slug);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //find si usa con id e no usiamo where 
       $post= Post::where('slug',$slug)->first();

       if(! $post){
           abort(404);
       }

       return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        if(! $post){
            abort(404);
        }

        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //VALIDATION
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();

        //UPDATE RECORD
        $post = Post::find($id);

        //update slug solo se titolo è cambiato
        if($data['title'] != $post->title){
            //GEN SLUG UNIVOCO
        $slug = Str::slug($data['title'],'-');
        $count = 1;
        $base_slug = $slug;

        //CICLO SE HO TROVATO POST CON SLUG ATTUALE
        while(Post::where('slug', $slug)->first()){
            //Gen. nuovo slug con contatore
            $slug .= $base_slug . '-'.$count;
            $count++;
        }
        $data['slug'] = $slug;
        }
        else{
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    //VALIDATION rules
private function validation_rules(){
    return[
        'title' => 'required|max:255',
        'content' => 'required'
    ];
}

private function validation_messages(){
    return[
        'required' => 'The :attribute is a required field',
        'max' => 'Max :max characters allowed for the :attribute'
    ];
}
}

