<?php

namespace App\Services;

use App\Repositories\Contracts\OauthRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Enumerable;

/**
 * Class DataParseService
 * @package App\Services
 */
class DataParseService
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var JsonFormatter
     */
    private $jsonFormatter;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var OauthRepositoryInterface
     */
    private $oauthRepository;

    /**
     * DataParseService constructor.
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     * @param JsonFormatter $jsonFormatter
     * @param Client $client
     * @param OauthRepositoryInterface $oauthRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        JsonFormatter $jsonFormatter,
        Client $client,
        OauthRepositoryInterface $oauthRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->jsonFormatter = $jsonFormatter;
        $this->client = $client;
        $this->oauthRepository = $oauthRepository;
    }

    /**
     * @return string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dataParse(): ?string
    {
        $getToken = $this->oauthRepository->getToken();

        if (null !== $getToken) {
            return $this->jsonFormatter->decode(
                $this->client->get('/devInterview/API/en/get-random-test-feed', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => $getToken['token_type'] . ' ' . $getToken['access_token'],
                    ],
                ])->getBody()
            );
        }
    }

    /**
     * @param array $order
     * @return object
     */
    public function saveOrder(array $order): object
    {
        return $this->orderRepository->saveOrder($order);
    }

    /**
     * @param array $product
     * @return object
     */
    public function saveProduct(array $product): object
    {
        return $this->productRepository->saveProduct($product);
    }

    /**
     * @return Enumerable
     */
    public function getOrders(): Enumerable
    {
        return $this->orderRepository->getOrders();
    }

    /**
     * @return Enumerable
     */
    public function getProducts(): Enumerable
    {
        return $this->productRepository->getProducts();
    }
}
