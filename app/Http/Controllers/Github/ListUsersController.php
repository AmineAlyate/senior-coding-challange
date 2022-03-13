<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;

class ListUsersController extends Controller
{
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