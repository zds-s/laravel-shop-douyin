<?php

namespace Xbhub\ShopDouyin\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;
    public function __construct($event)
    {
        $this->event = $event;
    }
}
