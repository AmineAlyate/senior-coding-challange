<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowRepositoryContributorsController extends Controller
{
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