<?php

namespace App\Http\Controllers;

use App\Services\GithubService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected GithubService $githubService;

    public function __construct()
    {
        $this->githubService = app(GithubService::class);
    }
}
