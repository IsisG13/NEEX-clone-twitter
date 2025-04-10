<?php
namespace App\Services;
use App\Repositories\UserRepository;
class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getUsers()
    {
        return $this->userRepository->getAll();
    }
    public function followUser(int $followerId, int $followedId)
    {
        // Não pode seguir a si mesmo
        if ($followerId === $followedId) {
            return false;
        }
        return $this->userRepository->follow($followerId, $followedId);
    }
    public function unfollowUser(int $followerId, int $followedId)
    {
        return $this->userRepository->unfollow($followerId, $followedId);
    }
    public function getFollowing(int $userId)
    {
        return $this->userRepository->getFollowing($userId);
    }
    public function getFollowers(int $userId)
    {
        return $this->userRepository->getFollowers($userId);
    }
    public function getUserById(int $id)
    {
        return $this->userRepository->findById($id);
    }
}