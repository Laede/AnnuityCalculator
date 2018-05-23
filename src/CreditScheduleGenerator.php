<?php

namespace Credit;

class CreditScheduleGenerator
{
    public function generateAnnuitySchedule(Credit $credit): Schedule
    {
        $amount = $credit->getAmount();
        $rate = $credit->getRate();
        $payments = $credit->getPaymentsCount();
        $date = $credit->getDate();

        $schedule = new Schedule();
        $payment = $this->calculatePayment($amount, $rate, $payments);


        for ($i = 0; $i < $payments; $i++) {
            $interest = $this->calculateInterest($amount, $rate);
            $creditAmount = $payment - $interest;

            $date = $date->copy();
            $date->addMonth();

            $schedule->addEntry(new ScheduleEntry($interest,$creditAmount,$payment,$date,$amount));

            $amount -= $creditAmount;
        }
        return $schedule;
    }

    private function calculatePayment($loan, $percent, $months)
    {
        $percent = ($percent) / 12;
        $per = 1 + $percent;
        $p = pow($per, $months);
        $a = $percent * $loan / (1 - (1 / $p));

        return $a;
    }

    private function calculateInterest($loan, $percent)
    {
        $interest = $loan * $percent / 12;

        return $interest;
    }
}