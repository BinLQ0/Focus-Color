<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 * Accumulate Stock by History
 */
trait AuthenticationLog
{
    /**
     * @return string
     */
    public function getlastSeenAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
