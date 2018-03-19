<?php

namespace App\Http\Controllers;

use App\Post;
use App\Person;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('is_anonymous','<>',1)->orderBy('created_at','desc')->get();
        // return $posts;
        return view ('posts.index',Compact ('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = \Auth::user()->id;
        $user_model = User::find($user_id);
        $user_person_id = $user_model->person->id;
        $user = Person::find($user_person_id);
        return view ('posts.create', Compact('user'));
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
        return redirect ('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

      $posts = Post::where('is_anonymous','<>',1)->with('comments')->orderBy('created_at','desc')->get();
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

      $user_id = \Auth::user()->id;
      $user_model = User::find($user_id);
      $user_person_id = $user_model->person->id;
      $user = Person::find($user_person_id);

        return view ('posts.show', Compact('post','next','previous','count','currentrecord','user'));
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
