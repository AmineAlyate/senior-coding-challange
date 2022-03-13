<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use App\Services\Github\GithubService;

class ListUsersController extends Controller
{
    public function __construct(private GithubService $githubService)
    {
        parent::__construct();
    }

    public function __invoke()
    {
        dd($this->githubService->getUsers());
        return view('repositories')->with(
            [
                'repositories' => $this->githubService->getRepositories(),
            ]
        );
    }
}