<?php

namespace App\Http\Controllers;

use App\Services\DataParseService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @return RedirectResponse|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function parseData(): ?RedirectResponse
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

            return redirect()->route('orders');
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

            return redirect()->route('products');
        }
    }

    /**
     * @return View
     */
    public function getOrders(): View
    {

        $orders = $this->dataParseService->getOrders();

        return view('orders.content', ['orders' => $orders]);
    }

    /**
     * @return View
     */
    public function getProducts(): View
    {
        $products = $this->dataParseService->getProducts();

        return view('products.content', ['products' => $products]);
    }
}
