<?php


namespace App\Repositories\Contracts;

use Illuminate\Support\Enumerable;

/**
 * Interface ProductRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface ProductRepositoryInterface
{
    /**
     * @param array $product
     * @return object
     */
    public function saveProduct(array $product): object;

    /**
     * @return Enumerable
     */
    public function getProducts(): Enumerable;
}
