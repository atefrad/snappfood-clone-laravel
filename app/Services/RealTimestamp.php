<?php

namespace App\Services;

class RealTimestamp
{
    public static function getRealTimestamp($timestamp, $time): string
    {
        $realTimeStamp = substr($timestamp, 0, 10);
        return date('Y-m-d', (int)$realTimeStamp) . ' ' . $time;
    }
}
