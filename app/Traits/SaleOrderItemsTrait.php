<?php

namespace SenseBook\Traits;

use SenseBook\Models\Product;
use SenseBook\Models\SaleOrder;
use SenseBook\Models\SaleOrderItem;

trait SaleOrderItemsTrait
{
    public function saveOrderLineItems(SaleOrder $order, $items, $qtys)
    {

        $products = Product::whereIn('id', $items)->get();

        if ($products && !empty($products)) {
            /**
             * Each item match with product id
             */
            foreach ($items as $key => $item) {
                $products = $products->map(function ($product) use ($item, $qtys, $key) {
                    if ($product->id === intval($item)) {
                        $product->quantity = intval($qtys[$key]);
                        $product->amount = $product->quantity * $product->suggested_retail_price;
                        $product->price_per_unit = $product->suggested_retail_price;
                        $product->points_per_unit = ($product->reward_points) ? $product->reward_points : 0;
                    }
                    return $product;
                });
            }

            SaleOrderItem::query()->where('sales_order_id', $order->id)->forceDelete();

            $products->each(function ($product) use ($order, &$storeItemsId) {

                $orderItem = new SaleOrderItem();

                $orderItem->fill($product->toArray());
                $orderItem->member_id = $order->member_id;
                $orderItem->sales_order_id = $order->id;
                $orderItem->document_date_id = $order->document_date_id;
                $orderItem->product_id = $product->id;
                $orderItem->save();

                $storeItemsId[] = $orderItem->id;
            });

            $order->price_before_discount = $order->items()->sum('amount');
            $order->total_price = $order->items()->sum('amount');

            $order->save();
        }
    }

    public function saveOrderItemFromProduct(SaleOrder $order, $products)
    {
        $storeItemsId = [];

        $products->each(function ($product) use ($order, &$storeItemsId) {

            $orderItem = SaleOrderItem::query()
                ->where('sales_order_id', $order->id)
                ->first();

            if (!$orderItem) {
                $orderItem = new SaleOrderItem();
            }

            $orderItem->quantity = $product->qty;
            $orderItem->amount = $product->quantity * $product->suggested_retail_price;
            $orderItem->price_per_unit = $product->suggested_retail_price;
            $orderItem->points_per_unit = ($product->reward_points) ? $product->reward_points : 0;
            $orderItem->member_id = $order->member_id;
            $orderItem->sales_order_id = $order->id;
            $orderItem->document_date_id = $order->document_date_id;
            $orderItem->product_id = $product->id;
            $orderItem->save();

            $storeItemsId[] = $orderItem->id;
        });

        $order->items()->whereNotIn('id', $storeItemsId)->forceDelete();

        $order->price_before_discount = $order->items()->sum('amount');
        $order->total_price = $order->items()->sum('amount');

        $order->save();
    }
}
