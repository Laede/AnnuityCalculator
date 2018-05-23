<?php

namespace App\Http\Controllers;

use Credit\Credit;
use Credit\CreditScheduleGenerator;
use Credit\Schedule;
use Credit\ScheduleEntry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Carbon\Carbon;

class ResultController extends BaseController
{
    /**
     *
     * @var CreditScheduleGenerator
     */
    private $scheduleGenerator;

    public function __construct(CreditScheduleGenerator $scheduleGenerator)
    {
        $this->scheduleGenerator = $scheduleGenerator;
    }

    public function showResult(Request $request)
    {
        $output = $this->prepareData($request);


        return view('table', [
            'schedule' => $output,
            'get_parameters' => $request->query()
        ]);
    }

    public function downloadResult(Request $request)
    {
        $output = $this->prepareData($request);

        $csv = [];
        $csv[] = [
            'Payments',
            'Date',
            'Remaining amount',
            'Principal payment',
            'Interest payment',
            'Total payment',
            'Interest rate'
        ];
        foreach ($output as $row) {
            $csv[] = [
                $row['payment_number'],
                $row['date'],
                $row['balance'],
                $row['credit'],
                $row['interest'],
                $row['payment'],
                $row['percent']
            ];
        }

        $response = new Response($this->generateCsv($csv));
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment;filename=output.csv');

        return $response;
    }

    private function prepareForOutput(Schedule $schedule): array
    {
        $res = [];
        $entries = $schedule->getEntries();
        $residue = 0;
        foreach ($entries as $key => $entry) {
            $row = $this->prepareRow($entry, $residue, $key+1 == count($entries));
            $residue += $this->calculateResidue($entry);
            $row['payment_number'] = $key + 1;
            $res[] = $row;
        }
        return $res;
    }

    private function calculateResidue(ScheduleEntry $entry) : float
    {
        $payment = $this->roundDown($entry->getPayment());
        $paymentResidue = $entry->getPayment() - $payment;

        $interest = $this->roundUp($entry->getInterest());
        $interestResidue = $interest - $entry->getInterest();

        $credit = $this->roundDown($entry->getCredit());
        $creditResidue = $entry->getCredit() - $credit;

        return $creditResidue + $paymentResidue + $interestResidue;
    }

    private function prepareRow(ScheduleEntry $entry, float $residue, bool $last): array
    {
        return [
            'balance' => $this->roundUp($entry->getBalance() + $residue),
            'credit' => $this->roundDown($last ? $entry->getCredit() + $residue : $entry->getCredit()),
            'interest' => $this->roundUp($entry->getInterest()),
            'payment' => $this->roundDown($last ? $entry->getPayment() + $residue : $entry->getPayment()),
            'date' => $entry->getDate()->toDateString(),
            'percent' => $entry->getInterestRate() * 100,
        ];
    }

    private function generateCsv(array $data)
    {
        $result = [];
        foreach ($data as $row) {
            $result[] = $this->generateCsvRow($row);
        }
        return implode("\n", $result);
    }

    private function generateCsvRow(array $row)
    {
        return implode(',', $row);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function prepareData(Request $request): array
    {
        $loan = $request->get('loan');
        $percent = $request->get('percent') / 100;
        $months = $request->get('months');
        $date = $request->get('date');
        $date = new Carbon($date);
        $credit = new Credit($loan, $percent, $months, $date);

        $schedule = $this->scheduleGenerator->generateAnnuitySchedule($credit);

        $output = $this->prepareForOutput($schedule);

        return $output;
    }

    private function roundUp($sk)
    {
        return round($sk, 2);
    }

    private function roundDown($sk)
    {
        return floor($sk * 100)/100;
    }
}