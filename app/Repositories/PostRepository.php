<?php


namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Comment;
use App\Models\Post;

class  PostRepository implements PostRepositoryInterface
{
    public function index()
    {
        return Post::all()->makeHidden(['content']);
    }

    public function create(array $data)
    {
        $data = array_merge($data,['user_id'=>auth()->user()->id]);
        return Post::create($data);
    }

    public function show($id)
    {
        $post = Post::find($id);
        $post['comments']=$post->comments;
        $post['tags']=$post->tags;
        return $post;
    }

    public function update($id,array $data)
    {
        $post = Post::find($id)->first();
        $post->update($data);
        return $post;
    }
}
