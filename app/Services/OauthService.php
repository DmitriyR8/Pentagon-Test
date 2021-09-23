<?php

namespace App\Services;

use App\Repositories\Contracts\OauthRepositoryInterface;

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
     * OauthService constructor.
     * @param OauthRepositoryInterface $oauthRepository
     */
    public function __construct(OauthRepositoryInterface $oauthRepository)
    {
        $this->oauthRepository = $oauthRepository;
    }

    /**
     * @return array
     */
    public function generateToken(): array
    {
        return $this->oauthRepository->oauth();
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
}
