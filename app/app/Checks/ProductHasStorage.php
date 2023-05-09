<?php

namespace App\Checks;

use App\Abstracts\AbstractsProductHasStorage;

class ProductHasStorage extends AbstractsProductHasStorage
{
    /**
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function hasStorage(array $request, $productRepository)
    {
        $productId = collect($request)->map(function ($product) {
            return $product['product_id'];
        });
        $products =  $productRepository->whereIn(values: $productId->toArray());
        $storages = array();
        // Sipariş oluşturulduğunda içerisindeki ürünler öncelikle tek bir depodan karşılanmalıdır.
        // ürünlerin depoları kendi içinde kontrol ediliyor.
        foreach ($products as $key => $value) {
           foreach ($value->storages->where('daily_order_limit', '>', 0)->sortBy('daily_order_limit')->reverse() as $key => $storage) {
                $storages[$storage->id][] = $value->id;
           }
        }
        // eğer ürün toplam sayısı depodaki ürün toplam sayısı ile eşleşirse x depoyu ata
        $hasStorages = array();
        foreach ($storages as $storeId => $store) {
            if (count($store) == $productId->count()) {
                foreach ($productId as $key => $pId) {
                    $hasStorages[$pId] = $storeId;
                }
            }
        }

        // Eğer tamamı tek bir depodan karşılanamıyorsa depoların önceliklendirilmesine göre en
        // öncelikli depoya sipariş gönderilmelidir.
        if (empty($hasStorages)) {
            $storages = array();
            foreach ($products as $key => $value) {
                    $storage = $value->storages->where('daily_order_limit', '>', 0)->sortBy('order_sort')->first();
                    $hasStorages[$value->id] = $storage->id;
            }
        }

        // TODO Ürünler için depo bulunmadıysa ne yapıalacak
        // if (count($hasStorages) == $productId->count()) {
        // }


        return $hasStorages;
    }
}
