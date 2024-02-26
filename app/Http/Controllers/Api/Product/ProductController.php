<?php

namespace App\Http\Controllers\Api\Product;

use App\DTO\Products\CreateProductDTO;
use App\DTO\Products\EditProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreUpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(private ProductRepository $productRepository)
    { 
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->getProducts(filter: $request->get('filter', ''));
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProductRequest $request)
    {        
        $product = $this->productRepository->createNew(new CreateProductDTO(... $request->validated()));
        return $this->show($product->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$product = $this->productRepository->findById($id)) {
            return response()->json(['message' => 'product not found'], Response::HTTP_NOT_FOUND);
        }
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProductRequest $request, string $id)
    {
        $response = $this->productRepository->update(new EditProductDTO(...[$id, ...$request->validated()]));
        if (!$response) {
            return response()->json(['message' => 'product not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(['message' => 'product updated with success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->productRepository->delete($id)) {
            return response()->json(['message' => 'product not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
