<?php

namespace Tests\Feature\Services;

use App\Services\Github\GithubService;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Collection;
use Tests\TestCase;

class GithubServiceTest extends TestCase
{
    public function test_authentication()
    {
        /** @var GithubService $githubService */
        $githubService = app(GithubService::class);

        $authResponse = $githubService->assertValidCredentials('amine', config('github.token'));

        $this->assertTrue($authResponse);
    }

    public function test_it_returns_repositories()
    {
        /** @var GithubService $githubService */
        $githubService = app(GithubService::class);

        $repositories = $githubService->getRepositories();

        $this->assertTrue($repositories instanceof Collection && $repositories->isNotEmpty());
    }

    private function initAuthentication(): void
    {
        /** @var RedisManager $redisManager */
        $redisManager = app(RedisManager::class);

        $redisManager->set(GithubService::USER_TOKEN, config('github.token'), GithubService::AUTH_TTL);
    }

    protected function setUp(): void
    {
        $this->initAuthentication();
    }
}
