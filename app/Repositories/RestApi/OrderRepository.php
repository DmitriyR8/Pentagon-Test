<?php

namespace App\Repositories\RestApi;

use App\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderRepository
 * @package App\Repositories\RestApi
 */
class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    private $model;

    /**
     * OrderRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $order
     * @return object
     */
    public function saveOrder(array $order): object
    {
        $qb = $this->model->newQuery();

        return $qb->updateOrCreate([
            'order_id' => $order['id'],
            'total' => $order['total'],
            'shipping_total' => $order['shipping_total'],
            'timezone' => $order['timezone'],
            'created_at' => Carbon::createFromTimestamp($order['create_time'])->toDateTimeString()
        ]);
    }

    /**
     * @return Enumerable
     */
    public function getOrders(): Enumerable
    {
        $qb = $this->model->newQuery();

        $qb->orderByDesc('id');

        return DB::transaction(function () use ($qb) {
            return $qb->get();
        });
    }
}
