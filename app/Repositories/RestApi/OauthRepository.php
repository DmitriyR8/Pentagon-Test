<?php

namespace App\Repositories\RestApi;

use App\ClientCredential;
use App\Repositories\Contracts\OauthRepositoryInterface;
use App\Services\JsonFormatter;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

/**
 * Class OauthRepository
 * @package App\Repositories\RestApi
 */
class OauthRepository implements OauthRepositoryInterface
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var JsonFormatter
     */
    private $jsonFormatter;
    /**
     * @var ClientCredential
     */
    private $model;

    /**
     * OauthRepository constructor.
     * @param Client $client
     * @param JsonFormatter $jsonFormatter
     * @param ClientCredential $model
     */
    public function __construct(
        Client $client,
        JsonFormatter $jsonFormatter,
        ClientCredential $model
    ) {
        $this->client = $client;
        $this->jsonFormatter = $jsonFormatter;
        $this->model = $model;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oauth(): array
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
