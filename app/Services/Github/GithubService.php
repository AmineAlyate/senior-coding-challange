<?php

namespace App\Services\Github;

use App\Models\DTO\Repository;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Collection;
use Throwable;

class GithubService
{
    public const AUTH_TTL = '1800'; // 30 min
    public const USER_NAME = 'user_name';
    public const USER_TOKEN = 'user_token';

    public function __construct(private Client $client, private RedisManager $redisManager)
    {
        $this->client = new Client(
            [
                RequestOptions::HEADERS      => ['Content-Type' => 'application/json'],
                [RequestOptions::HTTP_ERRORS => false],
            ]
        );
    }

    public function isAuthValid(string $userName, string $token): bool
    {
        try {
            $response = $this->client->get('https://api.github.com/user', [
                'auth' => [$userName, $token],
            ]);

            return $response->getStatusCode() === 200;
        } catch (Throwable $e) {
        }

        return false;
    }

    private function getGithubAuth(): array
    {
        return [
            $this->redisManager->get(self::USER_NAME),
            $this->redisManager->get(self::USER_TOKEN),
        ];
    }

    private function getToken(): string
    {
        return sprintf('token %s', $this->redisManager->get(self::USER_TOKEN));
    }

    /**
     * @return Collection|Repository[]
     */
    public function getRepositories()
    {
        $response = $this->client->get('https://api.github.com/user/repos?per_page=60', [
            RequestOptions::HEADERS => [
                'Authorization' => $this->getToken(),
            ],
        ]);

        return Collection::make(json_decode($response->getBody()->getContents(), true))
            ->map(function (array $data) {
                return Repository::createFromArray($data);
            });
    }

    public function getRepository(string $url): ?Repository
    {
        $response = $this->client->get($url, [
            RequestOptions::HEADERS => [
                'Authorization' => $this->getToken(),
            ],
        ]);

        return Repository::createFromArray(json_decode($response->getBody()->getContents(), true));
    }

    public function getRepositoryContributors(string $url)
    {
        $response = $this->client->get($url, [
            RequestOptions::HEADERS => [
                'Authorization' => $this->getToken(),
            ],
        ]);

        return Repository::createFromArray(json_decode($response->getBody()->getContents(), true));
    }

    public function getUsers()
    {
        $response = $this->client->get('https://api.github.com/orgs/nextmediama/members', [
            RequestOptions::HEADERS => [
                'Authorization' => $this->getToken(),
            ],
        ]);

        dd(json_decode($response->getBody()->getContents(), true));
    }
}