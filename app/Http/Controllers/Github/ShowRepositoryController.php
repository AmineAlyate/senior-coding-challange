<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use App\Services\Github\GithubService;
use Illuminate\Http\Request;

class ShowRepositoryController extends Controller
{
    public function __construct(private GithubService $githubService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        return view('show')->with(
            [
                'repository' => $this->githubService->getRepository($request->get('url')),
            ]
        );
    }
}