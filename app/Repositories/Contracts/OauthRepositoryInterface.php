<?php

namespace App\Repositories\Contracts;

/**
 * Interface OauthRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface OauthRepositoryInterface
{
    /**
     * @param array $credentials
     * @return object
     */
    public function saveToken(array $credentials): object;

    /**
     * @return object|null
     */
    public function getToken(): ?object;

    /**
     * @param string $accessToken
     * @param int $id
     * @return bool
     */
    public function updateToken(string $accessToken, int $id): bool;
}
