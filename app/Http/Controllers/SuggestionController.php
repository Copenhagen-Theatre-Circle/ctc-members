<?php

namespace App\Http\Controllers;

use App\Post;
use App\Person;
use App\User;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('is_anonymous','<>',1)->where('posttype_id',5)->orderBy('created_at','desc')->get();
        // return $posts;
        return view ('suggestions.index', Compact ('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('suggestions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect ('suggestions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
      $post = Post::where('id',$post)->first();
      $posts = Post::where('is_anonymous','<>',1)->where('posttype_id',5)->with('comments')->orderBy('created_at','desc')->get();
      foreach ($posts as $item) {
          $id_array[] = $item->id;
      }
      $current = $post->id;
      $currentkey = array_search($current, $id_array);
      $currentrecord = $currentkey + 1;
      $count = count($id_array);
      if ($currentkey + 1 < $count) {
          $next = $id_array[$currentkey + 1];
      } else {
          $next = "";
      }
      if ($currentkey > 0) {
          $previous = $id_array[$currentkey - 1];
      } else {
          $previous = "";
      }

        return view ('suggestions.show', Compact('post','next','previous','count','currentrecord'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
