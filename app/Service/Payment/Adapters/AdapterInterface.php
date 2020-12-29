<?php declare(strict_types=1);

namespace App\Service\Payment\Adapters;

use App\Models\Payment;

/**
 * Interface AdapterInterface
 * @package App\Service\Payment\Adapters
 */
interface AdapterInterface
{
    /**
     * @param Payment $payment
     * @return array
     */
    public function pay(Payment $payment) : array;

    /**
     * @param Payment $payment
     * @return int
     */
    public function payStatus(Payment $payment) : int;

    /**
     * @return string
     */
    public function adapterName() : string;
}
