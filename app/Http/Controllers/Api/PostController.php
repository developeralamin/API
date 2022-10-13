<?php

namespace App\Http\Controllers\Api;


use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Repository\PostRepository;

class PostController extends Controller
{

    private PostRepository $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->allPost();
        return response()->json([
            'success' => true,
            'message' => 'Post List',
            'data'    => $posts
        ]);
        /*  $data = $this->post->allPost();
        return PostResource::collection($data); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $post = $this->post->createPost($data);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  $this->post->findOrFail($id);
        return new PostResource($post);
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
        $data = $request->all();
        $this->post->update($id, $data);

        return response()->json([
            'status' => true,
            'message' => "Post Updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  $this->post->findOrFail($id);
        $post->delete($id);

        return response()->json([
            'status' => true,
            'message' => "Post deleted",
            'data' => $post
        ]);
    }
}
