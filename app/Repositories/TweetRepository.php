<?php
namespace App\Repositories;
use App\Models\Tweet;
use App\Models\User;
class TweetRepository
{
    protected $model;
    public function __construct(Tweet $model)
    {
        $this->model = $model;
    }
    public function create(array $data)
    {
        return $this->model->create([
            'content' => $data['content'],
            'user_id' => $data['user_id'],
        ]);
    }
    public function findById(int $id)
    {
        return $this->model->with(['user', 'comments.user'])->find($id);
    }
    public function getFeedForUser(int $userId)
    {
        $user = User::find($userId);
        // Obter IDs dos usuários que o usuário atual segue
        $followingIds = $user->following()->pluck('users.id')->toArray();
        // Adicionar ID do próprio usuário para ver seus próprios tweets
        $followingIds[] = $userId;
        // Buscar tweets dos usuários seguidos + tweets próprios
        return $this->model->whereIn('user_id', $followingIds)
            ->with(['user', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function getAllTweets()
    {
        return $this->model->with(['user', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}