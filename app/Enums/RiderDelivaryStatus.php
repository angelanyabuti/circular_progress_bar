<?php

namespace App\Enums;
use \Konekt\Enum\Enum;

class RiderDelivaryStatus extends Enum
{
    const __DEFAULT = self::PENDING;

    const PENDING   = 'pending';
    const ON_TRANSIT = 'on transit';
    const CANCELLED = 'cancelled';
    const COMPLETED = 'delivered';
}
