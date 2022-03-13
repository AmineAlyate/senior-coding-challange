<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;

class ListRepositoriesController extends Controller
{
    public function __invoke()
    {
        return view('repositories')->with(
            [
                'repositories' => $this->githubService->getRepsdositories(),
            ]
        );
    }
}