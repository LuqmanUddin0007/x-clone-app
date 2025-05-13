<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:280',

        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $data = $validator->validated();
        $data['user_id'] = auth()->user()->id;

        $post = $this->postRepo->create($data);

        return response()->json($post, 201);
    }

    public function getUserPosts()
    {
        $id = auth()->user()->id;
        $posts = $this->postRepo->getPostsByUserId($id);
        return response()->json($posts);
    }

    public function getUserPostsPublic($id)
    {
        $posts = \App\Models\Post::where('user_id', $id)
            ->latest()
            ->get();

        return response()->json($posts);
    }
}

