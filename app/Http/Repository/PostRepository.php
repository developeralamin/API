<?php

namespace App\Http\Repository;

use App\Models\Post;

class PostRepository
{

    /**
     * Get all posts here 
     *
     */
    public function allPost()
    {
        return Post::paginate(5);
    }

    /**
     * @return array
     * Create Post
     */
    public function createPost($data)
    {
        return Post::create($data);
    }
    /**
     * @param int $id
     *
     * @return mixed
     */

    public function findOrFail($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update a Post
     */
    public function update($id, $data)
    {
        $post = $this->findOrFail($id);
        return $post->update($data);
    }
}
