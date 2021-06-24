<?php

namespace App\Traits;

/**
 * Accumulate Stock by History
 */
trait HasStock
{
    use HasHistory;

    /**
     * Get Quantity Attributes
     */
    public function getQuantityAttribute()
    {
        return $this->getQuantity();
    }

    /**
     * Method to use calculate quantity's with 'histories' parameter 
     * 
     * @param String $date
     * @return int 
     */
    public function getWhereQuantity($key, $value)
    {
        $history = $this->history->load(['histories' => function ($query) use ($key, $value) {
            $query->where($key, '<=', $value);
        }]);

        return $this->getQuantity($history);
    }

    /**
     * Method to use calculate quantity's
     * 
     * @param App\Models\History $history
     * @return float
     */
    public function getQuantity($history = null): float
    {
        // Get quantity each type
        $debit  = $history->where('account', 'DEBIT')->sum('quantity');
        $credit = $history->where('account', 'CREDIT')->sum('quantity');

        return $debit - $credit;
    }
}
