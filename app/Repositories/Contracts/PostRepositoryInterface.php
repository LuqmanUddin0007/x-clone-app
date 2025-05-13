<?php
namespace App\Repositories\Contracts;

interface PostRepositoryInterface {
    public function getPostsByUserId($userId);
    public function create(array $data);
}
