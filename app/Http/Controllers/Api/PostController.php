<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'tags' => 'nullable',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'errorMsg' => ($validator->errors()),
                'msg' => '',
                'data' => ""
            ], 400);
        }

        $post = $this->post->createPost($request->all());
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'tags' => 'nullable',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'errorMsg' => ($validator->errors()),
                'msg' => '',
                'data' => ""
            ], 400);
        }
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
