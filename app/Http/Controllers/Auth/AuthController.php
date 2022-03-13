<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\GithubService;
use Illuminate\Redis\RedisManager;

class AuthController extends Controller
{
    public function __construct(private RedisManager $redisManager)
    {
        parent::__construct();
    }

    public function __invoke(AuthRequest $request)
    {
        $username = $request->get('user_name');
        $token = $request->get('user_token');

        if (! $this->githubService->isAuthValid($username, $token)) {
            return redirect()->back()->withErrors('Invalid credentials');
        }

        $this->redisManager->set(GithubService::USER_NAME, $username, GithubService::AUTH_TTL);
        $this->redisManager->set(GithubService::USER_TOKEN, $token, GithubService::AUTH_TTL);

        return redirect()->back()->with('success', 'Token Saved Successfully');
    }
}