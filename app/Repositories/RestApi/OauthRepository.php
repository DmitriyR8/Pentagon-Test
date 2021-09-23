<?php

namespace App\Repositories\RestApi;

use App\ClientCredential;
use App\Repositories\Contracts\OauthRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class OauthRepository
 * @package App\Repositories\RestApi
 */
class OauthRepository implements OauthRepositoryInterface
{
    /**
     * @var ClientCredential
     */
    private $model;

    /**
     * OauthRepository constructor.
     * @param ClientCredential $model
     */
    public function __construct(ClientCredential $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $credentials
     * @return object
     */
    public function saveToken(array $credentials): object
    {
        $qb = $this->model->newQuery();

        return $qb->create([
            'token_type' => $credentials['token_type'],
            'expires_in' => $credentials['expires_in'],
            'access_token' => $credentials['access_token'],
            'changePassword' => $credentials['changePassword'],
            'sellerId' => $credentials['sellerId'],
        ]);
    }

    /**
     * @return object|null
     */
    public function getToken(): ?object
    {
        $qb = $this->model->newQuery();

        $qb->orderBy('created_at', 'desc');

        return DB::transaction(function () use ($qb) {
            return $qb->first();
        });
    }


    /**
     * @param string $accessToken
     * @param int $id
     * @return bool
     */
    public function updateToken(string $accessToken, int $id): bool
    {
        $qb = $this->model->newQuery();

        $qb->where('id', $id);

        return $qb->update(['access_token' => $accessToken]);
    }
}
