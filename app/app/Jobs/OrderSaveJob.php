<?php

namespace App\Jobs;

use App\Repositories\Interfaces\Orders\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderSaveJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Summary of decodeJson
     * @var mixed
     */
    private $decodeJson;


    private $collection;
    private $orderRepositoryInterface;

    /**
     * Summary of __construct
     * @param array $collection
     * @return void
     */
    public function __construct(array $collection, OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->collection = $collection;
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    /**
     * The unique ID of the job.
     */
    public function uniqueId(): string
    {
        return md5($this->collection['order']['number']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        $order = $this->orderRepositoryInterface->store($this->collection['order']);
        $orderItem = $order->orderItem()->createMany($this->collection['order_items']);
        foreach ($orderItem as $key => $value) {
            $value->product->stock = $value->product->stock - $value->stock;
            $value->product->save();
            // bekleyen işler öncesinde stok kontrolü
            if ($value->product->stock < 0) {
                Log::info('ürün stok sıfırın altında', [$this->collection]);
                DB::rollBack();
                // TODO:siparişin oluşturulması başarısız. iletişime geç
            }
        }
        DB::commit();

        // depoları günlük siparişleri sayılıyor
        foreach (array_unique($this->collection['order']['storages']) as $key => $storageId) {
            Cache::increment('storage_' . $storageId . Carbon::now()->format("Y-m-d"));
        }
    }
}
