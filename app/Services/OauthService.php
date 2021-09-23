<?php

namespace App\Services;

use App\Repositories\Contracts\OauthRepositoryInterface;
use GuzzleHttp\Client;

/**
 * Class OauthService
 * @package App\Services
 */
class OauthService
{
    /**
     * @var OauthRepositoryInterface
     */
    private $oauthRepository;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var JsonFormatter
     */
    private $jsonFormatter;

    /**
     * OauthService constructor.
     * @param OauthRepositoryInterface $oauthRepository
     * @param Client $client
     * @param JsonFormatter $jsonFormatter
     */
    public function __construct(
        OauthRepositoryInterface $oauthRepository,
        Client $client,
        JsonFormatter $jsonFormatter
    ) {
        $this->oauthRepository = $oauthRepository;
        $this->client = $client;
        $this->jsonFormatter = $jsonFormatter;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generateToken(): array
    {
        return $this->jsonFormatter->decode(
            $this->client->post('/devInterview/API/en/access-token', [
                'form_params' => [
                    'client_id' => env('OAUTH_CLIENT_ID'),
                    'client_secret' => env('OAUTH_CLIENT_SECRET')
                ]
            ])->getBody()
        );
    }

    /**
     * @param array $credentials
     * @return object
     */
    public function saveToken(array $credentials): object
    {
        return $this->oauthRepository->saveToken($credentials);
    }

    /**
     * @return object|null
     */
    public function getToken(): ?object
    {
        return $this->oauthRepository->getToken();
    }

    /**
     * @param string $accessToken
     * @param int $id
     * @return bool
     */
    public function updateToken(string $accessToken, int $id): bool
    {
        return $this->oauthRepository->updateToken($accessToken, $id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteToken(int $id)
    {
        return $this->oauthRepository->deleteToken($id);
    }
}
