<?php

namespace App\Checks;

use App\Abstracts\AbstractsProductHasStorage;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ProductHasStorage extends AbstractsProductHasStorage
{
    /**
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function hasStorage(array $request, ProductRepositoryInterface $productRepository)
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
                // Depolara günlük sipariş limiti konulabilmektedir. Sipariş limit kontrol
                if (Cache::get('storage_' . $storage->id . Carbon::now()->format("Y-m-d")) >= $storage->daily_order_limit) {
                    continue;
                }
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
                    // Depolara günlük sipariş limiti konulabilmektedir. Sipariş limit kontrol
                    if (Cache::get('storage_' . $storage->id . Carbon::now()->format("Y-m-d")) >= $storage->daily_order_limit) {
                        continue;
                    }
                    $hasStorages[$value->id] = $storage->id;
            }
        }

        // TODO Ürünler için depo bulunmadıysa ne yapıalacak
        // if (count($hasStorages) == $productId->count()) {
        // }


        return $hasStorages;
    }
}
