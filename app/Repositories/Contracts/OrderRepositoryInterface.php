<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Enumerable;

/**
 * Interface OrderRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface OrderRepositoryInterface
{
    /**
     * @param array $order
     * @return object
     */
    public function saveOrder(array $order): object;

    /**
     * @return Enumerable
     */
    public function getOrders(): Enumerable;
}
