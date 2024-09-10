<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function setData(CreateProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function getData($id)
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

        $result = $data->map(function ($seller) {
            return [
                'seller_name' => $seller->seller_name,
                'phone_names' => $seller->products->pluck('phone_name'),
            ];
        });

        return response()->json([
            'success' => true,
            'result' => $result
        ]);
    }

    public function bulkInsert(Request $request)
    {
        $products = json_decode($request->input('products'), true);
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

        DB::table('seller_product')->insert($insertData);

        return response()->json([
            'success' => true
        ]);
    }

    public function updateDataBulk(Request $request)
    {
        $ids = json_decode($request->input('ids'));
        $cost = $request->input('cost', 0);

        Product::whereIn('id', $ids)->update(['cost' => $cost]);

        return response()->json([
            'success' => true
        ]);
    }
}
