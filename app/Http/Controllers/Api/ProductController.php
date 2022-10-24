<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\ProductRepository;

class ProductController extends Controller
{
    private ProductRepository $product;

    public function __construct()
    {
        $product = new ProductRepository();
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product =  $this->product->allProduct();
        // return ProductResource::collection($data);
        return response()->json([
            'success' => true,
            'message' => 'Product List',
            'data'    => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'post_id' => 'nullable',
            'sale_price' => 'nullable',
            'cost_price' => 'nullable',
            'photo' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'errorMsg' => ($validator->errors()),
                'msg' => '',
                'data' => ""
            ], 400);
        }
        $data = $request->all();
        $product =  $this->product->createProduct($data);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  $this->product->findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'post_id' => 'nullable',
            'sale_price' => 'nullable',
            'cost_price' => 'nullable',
            'photo' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'errorMsg' => ($validator->errors()),
                'msg' => '',
                'data' => ""
            ], 400);
        }

        $data =  $request->all();
        $this->product->update($id, $data);

        return response()->json([
            'status' => true,
            'message' => 'Product Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  $this->product->findOrFail($id);
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => "Product Deleted Successfully",
            'data' => $product
        ]);
    }
}
