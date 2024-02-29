<?php

namespace App\DTO\Products;

use Illuminate\Http\UploadedFile;

class CreateProductDTO
{
    public function __construct(
        readonly public string $name,
        readonly public string $description,
        readonly public string $price,
        readonly public string $expiration_date,
        readonly public UploadedFile $image,
        readonly public string $category_id,
    ) { }
}