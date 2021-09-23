<?php

namespace App\Http\Controllers;

use App\Services\OauthService;

/**
 * Class OauthController
 * @package App\Http\Controllers
 */
class OauthController
{
    /**
     * @var OauthService
     */
    private $oauthService;

    /**
     * OauthController constructor.
     * @param OauthService $oauthService
     */
    public function __construct(OauthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * @return void
     */
    public function login(): void
    {
        $generateToken = $this->oauthService->generateToken();

        $getToken = $this->oauthService->getToken();

        if (null !== $getToken) {
            $this->oauthService->updateToken($generateToken['access_token'], $getToken->id);
        } else {
            $this->oauthService->saveToken($generateToken);
        }
    }
}
