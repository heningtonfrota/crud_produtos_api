<?php

namespace App\DTO\Products;

class EditProductDTO
{
    public function __construct(
        readonly public string $id,
        readonly public string $name,
        readonly public string $description,
        readonly public string $price,
        readonly public string $expiration_date,
        readonly public string $category_id,
    ) {
        //
    }
}