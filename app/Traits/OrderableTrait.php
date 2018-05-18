<?php

namespace SenseBook\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;

trait OrderableTrait
{
    public function totalWeight(Collection $products)
    {
        return $products->sum(function ($product) {
            return $product->weight * $product->qty;
        });
    }
}
