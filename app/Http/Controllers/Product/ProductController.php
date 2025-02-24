<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ProductController extends Controller
{
    public function index(): Response
    {
        try {
            $products = ProductService::getWithPaginate();
            if (!$products) {
                return Inertia::render('Error', [
                    'error' => [
                        'message' => 'Products not found.',
                        'status' => 404,
                    ]
                ]);
            }
            return Inertia::render('Home', compact('products'));
        } catch (Throwable $th) {
            return Inertia::render('Error', [
                'th' => [
                    'message' => $th->getMessage(),
                    'status' => $th instanceof HttpException ? $th->getStatusCode() : 500,
                ]
            ]);
        }
    }

    public function show(String $id): Response
    {
        try {
            $product = ProductService::get((Int) $id);
            if (!$product) {
                return Inertia::render('Error', [
                    'th' => [
                        'message' => 'Product not found.',
                        'status' => 404,
                    ]
                ]);
            }
            return Inertia::render('Product', compact('product'));
        } catch (Throwable $th) {
            return Inertia::render('Error', [
                'th' => [
                    'message' => $th->getMessage(),
                    'status' => $th instanceof HttpException ? $th->getStatusCode() : 500,
                ]
            ]);
        }
    }
}
