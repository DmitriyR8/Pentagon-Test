<?php

namespace App\Repositories\RestApi;

use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductRepository
 * @package App\Repositories\RestApi
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    private $model;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $product
     * @return object
     */
    public function saveProduct(array $product): object
    {
        $qb = $this->model->newQuery();

        return $qb->updateOrCreate([
            'title' => $product['title'],
            'SKU' => $product['SKU']
        ]);
    }

    /**
     * @return Enumerable
     */
    public function getProducts(): Enumerable
    {
        $qb = $this->model->newQuery();

        $qb->orderByDesc('id');

        return DB::transaction(function () use ($qb) {
            return $qb->get();
        });
    }
}
