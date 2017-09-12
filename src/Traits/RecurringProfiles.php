<?php

namespace Srmklive\PayPal\Traits;

use Carbon\Carbon;

trait RecurringProfiles
{
    /**
     * Create recurring subscription on monthly basis.
     *
     * @param string $token
     * @param float  $amount
     * @param string $description
     *
     * @return array
     */
    public function createMonthlySubscription($token, $amount, $description)
    {
        $data = [
            'PROFILESTARTDATE'  => Carbon::now()->toAtomString(),
            'DESC'              => $description,
            'BILLINGPERIOD'     => 'Month',
            'BILLINGFREQUENCY'  => 1,
            'AMT'               => $amount,
            'CURRENCYCODE'      => $this->currency,
        ];

        return $this->createRecurringPaymentsProfile($data, $token);
    }

    /**
     * Create recurring subscription on yearly basis.
     *
     * @param string $token
     * @param float  $amount
     * @param string $description
     *
     * @return array
     */
    public function createYearlySubscription($token, $amount, $description)
    {
        $data = [
            'PROFILESTARTDATE'  => Carbon::now()->toAtomString(),
            'DESC'              => $description,
            'BILLINGPERIOD'     => 'Year',
            'BILLINGFREQUENCY'  => 1,
            'AMT'               => $amount,
            'CURRENCYCODE'      => $this->currency,
        ];

        return $this->createRecurringPaymentsProfile($data, $token);
    }

    /**
     * Create recurring subscription with init amount on monthly period basis.
     *
     * @param string $token
     * @param float $amount
     * @param string $description
     * @param float $initAmount
     * @param Carbon $profileStartDate
     *
     * @return array*
     */
    public function createMonthlySubscriptionWithInitAmount($token, $amount, $description, $initAmount, $profileStartDate = null)
    {
        if (is_null($profileStartDate)) {
            $profileStartDate = Carbon::now();
        }

        $data = [
            'PROFILESTARTDATE'      => $profileStartDate->toAtomString(),
            'DESC'                  => $description,
            'BILLINGPERIOD'         => 'Year',
            'BILLINGFREQUENCY'      => 1,
            'AMT'                   => $amount,
            'CURRENCYCODE'          => $this->currency,
            'INITAMT'               => $initAmount,
            'FAILEDINITAMTACTION'   => 'CancelOnFailure'
        ];

        return $this->createRecurringPaymentsProfile($data, $token);
    }
}
