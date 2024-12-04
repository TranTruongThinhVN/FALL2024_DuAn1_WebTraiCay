<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class SkuProductVariantOption extends BaseModel
{
    protected $table = 'skus_product_variant_options'; // Tên bảng trung gian

    public function createSkuProductVariantOption($data)
    {
        return $this->create($data);
    }
}
