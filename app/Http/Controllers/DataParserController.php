<?php

namespace App\Http\Controllers;

use App\Services\DataParseService;
use Illuminate\Support\Enumerable;

/**
 * Class DataParserController
 * @package App\Http\Controllers
 */
class DataParserController extends Controller
{
    /**
     * @var DataParseService
     */
    private $dataParseService;

    /**
     * DataParserController constructor.
     * @param DataParseService $dataParseService
     */
    public function __construct(DataParseService $dataParseService)
    {
        $this->dataParseService = $dataParseService;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function parseData(): void
    {
        $data = $this->dataParseService->dataParse();

        if (strpos($data, 'order:') !== false) {
            $data = str_replace('order:', '',
                str_replace('}','',
                    str_replace('{','=',
                        str_replace('||','&', $data)
                    )
                )
            );

            parse_str($data, $order);

            $this->dataParseService->saveOrder($order);
        }

        if (strpos($data, 'product:') !== false) {
            $data = str_replace('product:', '',
                str_replace('}','',
                    str_replace('{','=',
                        str_replace('||','&', $data)
                    )
                )
            );

            parse_str($data, $product);

            $this->dataParseService->saveProduct($product);
        }
    }

    /**
     * @return Enumerable
     */
    public function getOrders(): Enumerable
    {
        return $this->dataParseService->getOrders();
    }

    /**
     * @return Enumerable
     */
    public function getProducts(): Enumerable
    {
        return $this->dataParseService->getProducts();
    }
}
