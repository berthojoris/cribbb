<?php

use Cribbb\Storage\Post\PostRepository as Post;

class PostController extends BaseController {

  /**
   * Post Repository
   */
  protected $post;

  /**
   * Inject the User Repository
   */
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return $this->post->all();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('posts.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $s = $this->post->create(Input::all());

    if($s->passes())
    {
      return Redirect::route('posts.index')
        ->with('flash', 'A new has been created');
    }

    return Redirect::route('posts.create')
      ->withInput()
      ->withErrors($s->errors());
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    return $this->post->find($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    return View::make('posts.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $s = $this->post->update($id);

    if($s->passes())
    {
      return Redirect::route('posts.show', $id)
        ->with('flash', 'The post was updated');
    }

    return Redirect::route('posts.edit', $id)
      ->withInput()
      ->withErrors($s->errors());
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    return $this->post->delete($id);
  }

}