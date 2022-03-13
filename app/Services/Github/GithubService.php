<?php

namespace App\Services\Github;

use App\Models\DTO\Repository;
use App\Services\Github\Exceptions\BaseGithubException;
use App\Services\Github\Exceptions\InvalidCredentialsException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GithubService
{
    public const AUTH_TTL = '1800'; // 30 min
    public const USER_NAME = 'user_name';
    public const USER_TOKEN = 'user_token';

    public function __construct(private Client $client)
    {
        $this->client = new Client(
            [
                RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
                RequestOptions::HTTP_ERRORS => false,
            ]
        );
    }

    public function assertCredentialsValid(string $userName, string $token): bool
    {
        try {
            $response = $this->client->get('https://api.github.com/user', [
                'auth' => [$userName, $token],
            ]);

            if ($response->getStatusCode() === Response::HTTP_UNAUTHORIZED) {
                throw new InvalidCredentialsException();
            }

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new BaseGithubException();
            }

            return $response->getStatusCode() === 200;
        } catch (BaseGithubException $e) {
            throw $e;
        } catch (Throwable $e) {
            // Log error with the response data
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