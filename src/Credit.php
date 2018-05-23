<?php

namespace Credit;

use Carbon\Carbon;

class Credit
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var int
     */
    private $paymentsCount;

    /**
     * @var Carbon
     */
    private $data;

    public function __construct(int $amount, float $rate, int $paymentsCount, Carbon $data)
    {
        $this->amount = $amount;
        $this->rate = $rate;
        $this->paymentsCount = $paymentsCount;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return int
     */
    public function getPaymentsCount()
    {
        return $this->paymentsCount;
    }

    /**
     * @return Carbon
     */
    public function getDate()
    {
        return $this->data;
    }
}
