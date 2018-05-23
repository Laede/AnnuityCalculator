<?php

namespace Credit;

use Carbon\Carbon;

class ScheduleEntry
{
    /**
     * @var float
     */
    private $interest;
    /**
     * @var float
     */
    private $credit;
    /**
     * @var float
     */
    private $payment;
    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var float
     */
    private $balance;

    /**
     * @var float
     */
    private $interestRate;

    public function __construct(float $interestRate,float $interest, float $credit, float $payment, Carbon $date, float $balance)
    {

        $this->interest = $interest;
        $this->credit = $credit;
        $this->payment = $payment;
        $this->date = $date;
        $this->balance = $balance;
        $this->interestRate = $interestRate;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }


    /**
     * @return float
     */
    public function getInterest(): float
    {
        return $this->interest;
    }

    /**
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /**
     * @return float
     */
    public function getPayment(): float
    {
        return $this->payment;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    public function getInterestRate()
    {
        return $this->interestRate;
    }


}