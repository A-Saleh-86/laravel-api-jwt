<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;


class ProductController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get all products",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */


    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'product' => $products,
        ]);
    }

    /**

     * @OA\Post(

     *     path="/api/product",

     *     summary="Create a new product",

     *     tags={"Products"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\RequestBody(

     *         @OA\JsonContent(

     *             type="object",

     *             @OA\Property(property="name", type="string"),

     *             @OA\Property(property="description", type="string"),

     *             @OA\Property(property="prices", type="integer"),

     *             @OA\Property(property="currency", type="string"),

     *             @OA\Property(property="stock_quantity", type="integer")

     *         )

     *     ),

     *     @OA\Response(response=201, description="Product created successfully")

     * )

     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'prices' => 'required|integer',
            'currency' => 'required',
            'stock_quantity' => 'required|integer'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'prices' => $request->prices,
            'currency' => $request->currency,
            'stock_quantity' => $request->stock_quantity,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'product' => $product,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     summary="Get a product by ID",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(
     *         description="Product ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful response"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Product not found")
     * )
     */

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => 'success',
            'product' => $product,
        ]);
    }

    /**

     * @OA\Put(

     *     path="/api/product/{id}",

     *     summary="Update a product",

     *     tags={"Products"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(

     *         description="Product ID",

     *         in="path",

     *         name="id",

     *         required=true,

     *         @OA\Schema(type="integer")

     *     ),

     *     @OA\RequestBody(

     *         @OA\JsonContent(

     *             type="object",

     *             @OA\Property(property="name", type="string"),

     *             @OA\Property(property="description", type="string"),

     *             @OA\Property(property="prices", type="integer"),

     *             @OA\Property(property="currency", type="string"),

     *             @OA\Property(property="stock_quantity", type="integer")

     *         )

     *     ),

     *     @OA\Response(response=200, description="Product updated successfully")

     * )

     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'prices' => 'required|integer',
            'currency' => 'required',
            'stock_quantity' => 'required|integer'
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->prices = $request->prices;
        $product->currency = $request->currency;
        $product->stock_quantity = $request->stock_quantity;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => $product,
        ]);
    }

    /**

     * @OA\Delete(

     *     path="/api/product/{id}",

     *     summary="Delete a product",

     *     tags={"Products"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(

     *         description="Product ID",

     *         in="path",

     *         name="id",

     *         required=true,

     *         @OA\Schema(type="integer")

     *     ),

     *     @OA\Response(response=200, description="Product deleted successfully")

     * )

     */

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully',
            'product' => $product,
        ]);
    }
}
