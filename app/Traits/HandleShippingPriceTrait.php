<?php
namespace SenseBook\Traits;

use SenseBook\Models\ShippingFee;

trait HandleShippingPriceTrait
{
    public function calculateShippingPrice($shippingTypeId, $regionId, $weight)
    {
        $faceShipping = ShippingFee::query()
            ->where('type_id', $shippingTypeId)
            ->where('region_id', $regionId)
            ->get();

        $faceShipping = $faceShipping->filter(function ($face) use ($weight) {
            return (
            ($weight >= $face->minimum_weight && $weight <= $face->maximum_weight) ||
            (is_null($face->maximum_weight) && $weight >= $face->minimum_weight)
            );
        });

        return ($faceShipping) ? $faceShipping->first()->amount : 0;
    }
}
