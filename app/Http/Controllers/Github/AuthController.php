<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Github\Exceptions\BaseGithubException;
use App\Services\Github\Exceptions\InvalidCredentialsException;
use App\Services\Github\GithubService;
use Illuminate\Redis\RedisManager;
use Throwable;

class AuthController extends Controller
{
    public function __construct(private RedisManager $redisManager, private GithubService $githubService)
    {
        parent::__construct();
    }

    public function __invoke(AuthRequest $request)
    {
        try {
            $username = $request->get('user_name');
            $token = $request->get('user_token');

            $this->githubService->assertValidCredentials($username, $token);

            $this->redisManager->set(GithubService::USER_NAME, $username, GithubService::AUTH_TTL);
            $this->redisManager->set(GithubService::USER_TOKEN, $token, GithubService::AUTH_TTL);

            return redirect()->back()->with('success', 'Token Saved Successfully');
        } catch (InvalidCredentialsException $e) {
            return redirect()->back()->withErrors('Invalid token');
        } catch (BaseGithubException $e) {
            return redirect()->back()->withErrors('error occurred try again later please');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors('Internal server error');
        }
    }
}