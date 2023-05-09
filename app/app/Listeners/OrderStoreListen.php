<?php

namespace App\Listeners;

use App\Events\OrderStoreEvent;
use App\Jobs\OrderSaveJob;
use App\Repositories\Interfaces\Orders\OrderRepositoryInterface;

class OrderStoreListen
{
    private $orderRepository;
    /**
     * Create the event listener.
     * @param OrderRepositoryInterface $orderRepository
     * @return void
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderStoreEvent  $event
     * @return void
     */
    public function handle(OrderStoreEvent $event)
    {
        OrderSaveJob::dispatch($event->collections, $this->orderRepository);
    }
}
