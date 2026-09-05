<?php

namespace App\Events;

use App\Models\StockType;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stockType;

    /**
     * Create a new event instance.
     */
    public function __construct(StockType $stockType)
    {
        $this->stockType = $stockType;
    }
}
