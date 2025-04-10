<?php
namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;
class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getUsers();
        return response()->json(['users' => $users]);
    }
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return response()->json(
                ['message' => 'Usuário não encontrado'],
                404
            );
        }
        return response()->json(['user' => $user]);
    }
    public function follow(Request $request, $id)
    {
        $followerId = auth()->id();
        $followedId = $id;
        $result = $this->userService->followUser($followerId, $followedId);
        if (!$result) {
            return response()->json([
                'message' => 'Não foi possível seguir este
usuário'
            ], 400);
        }
        return response()->json(['message' => 'Usuário seguido com sucesso']);
    }
    public function unfollow(Request $request, $id)
    {
        $followerId = auth()->id();
        $followedId = $id;
        $result = $this->userService->unfollowUser($followerId, $followedId);
        return response()->json([
            'message' => 'Deixou de seguir este usuário
com sucesso'
        ]);
    }
    public function following($id)
    {
        $following = $this->userService->getFollowing($id);
        return response()->json(['following' => $following]);
    }
    public function followers($id)
    {
        $followers = $this->userService->getFollowers($id);
        return response()->json(['followers' => $followers]);
    }
}