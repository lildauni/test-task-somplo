<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\BulkInsertProductRequest;
use App\Http\Requests\BulkUpdateProductRequest;
use App\Http\Resources\SellerResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function setData(CreateProductRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $product = Product::create($data);

        return response()->json([
            'product' => $product
        ]);
    }

    public function getData(int $id) : JsonResponse
    {
        $product = Product::findOrFail($id);
        $data = $product->sellers()
            ->whereHas('products', function ($query) {
                $query->where('display_size', '>', 5);
            })
            ->with(['products' => function ($query) {
                $query->where('display_size', '>', 5)
                    ->select('phone_name');
            }])
            ->get();

        return response()->json(SellerResource::collection($data));
    }

    public function bulkInsert(BulkInsertProductRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $products = $data['products'];
        $productsInsert = array_map(function ($products) {
            unset($products['seller_id']);
            return $products;
        }, $products);
        Product::insert($productsInsert);

        $productIds = Product::whereIn('phone_name', array_column($products, 'phone_name'))
            ->pluck('id', 'phone_name')->toArray();

        $insertData = array_reduce($products, function ($data, $product) use ($productIds) {
            $productId = $productIds[$product['phone_name']];
            $data[] = [
                'product_id' => $productId,
                'seller_id' => $product['seller_id']
            ];
            return $data;
        }, []);

        DB::table('product_seller')->insert($insertData);

        return response()->json([
            'success' => true
        ]);
    }

    public function updateDataBulk(BulkUpdateProductRequest $request) : JsonResponse
    {
        $data = $request->validated();

        Product::whereIn('id', $data['ids'])->update(['cost' => $data['cost']]);

        return response()->json([
            'success' => true
        ]);
    }
}
