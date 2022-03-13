<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use App\Services\Github\GithubService;
use Illuminate\Http\Request;

class ShowRepositoryContributorsController extends Controller
{
    public function __construct(private GithubService $githubService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        dd($this->githubService->getRepositoryContributors($request->get('contributors_url')));
        return view('show')->with(
            [
                'repository' => $this->githubService->getRepository($request->get('url')),
            ]
        );
    }
}