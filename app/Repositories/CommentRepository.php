<?php


namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use App\Models\Tag;

class  CommentRepository implements CommentRepositoryInterface
{
    public function create(array $data)
    {
        return Comment::create(array_merge($data,['user_id'=>auth()->user()->id]));
    }
    public function update($id,array $data)
    {
        $comment = Comment::find($id);
        $comment->update($data);
        return $comment;
    }

    public function delete(array $data)
    {
        $comment = Comment::find($data['id']);
        $comment->delete();
        return $comment;
    }
}
