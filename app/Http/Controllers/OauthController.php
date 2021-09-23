<?php

namespace App\Http\Controllers;

use App\Services\OauthService;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class OauthController
 * @package App\Http\Controllers
 */
class OauthController extends Controller
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

    public function index()
    {
        return view('login');
    }

    /**
     * @return RedirectResponse|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(): ?RedirectResponse
    {
        $generateToken = $this->oauthService->generateToken();

        $getToken = $this->oauthService->getToken();

        if (null !== $getToken) {
            $this->oauthService->updateToken($generateToken['access_token'], $getToken->id);
        } else {
            $this->oauthService->saveToken($generateToken);
        }

        return redirect()->route('orders');
    }

    /**
     * @return RedirectResponse|null
     */
    public function logout(): ?RedirectResponse
    {
        $getToken = $this->oauthService->getToken();

        if (null !== $getToken) {
            $this->oauthService->deleteToken($getToken->id);

            return redirect()->route('index');
        }

        return null;
    }
}
