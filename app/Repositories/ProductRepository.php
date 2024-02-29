<?php

namespace App\Repositories;

use App\DTO\Products\CreateProductDTO;
use App\DTO\Products\EditProductDTO;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function __construct(protected Product $product)
    {   }

    public function getProducts(string $filter = ''): LengthAwarePaginator
    {
        return $this->product->where(function ($query) use ($filter) {
            if ($filter !== '') {
                $query
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%");
            }
        })
        ->with(['category'])
        ->paginate();
    }

    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''): LengthAwarePaginator
    {
        return $this->product->where(function ($query) use ($filter) {
            if ($filter !== '') {
                $query
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%");
            }
        })
        ->with(['category'])
        ->paginate($totalPerPage, ['*'], 'page', $page);
    }

    public function createNew(CreateProductDTO $dto): ?Product
    {
        $data = (array) $dto;
        
        $name = time() . '.' . $data['image']->getClientOriginalExtension();
        $data['image']->storeAs('public/products/', $name);
        $data['image'] = $name;
        
        return $this->product->create($data);
    }

    public function findById(string $id): ?Product
    {
        $product = $this->product->with('category')->find($id);
        return $product;
    }

    public function update(EditProductDTO $dto): bool
    {
        if (!$product = $this->findById($dto->id)) {
            return false;
        }
        $data = (array) $dto;
        return $product->update($data);
    }

    public function delete(string $id): bool
    {
        if (!$product = $this->findById($id)) {
            return false;
        }
        return $product->delete();
    }
}
