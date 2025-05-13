<?php 

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getPostsByUserId($userId)
    {
        return Post::where('user_id', $userId)->latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }
}
