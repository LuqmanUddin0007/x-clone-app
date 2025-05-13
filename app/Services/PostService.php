<?php
namespace App\Services;

use App\Repositories\Contracts\PostRepositoryInterface;

class PostService {
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function createPost(array $data) {
        return $this->postRepository->create($data);
    }
}
