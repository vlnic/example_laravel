<?php declare(strict_types=1);

namespace App\Service\Payment\Adapters;

use App\Models\Payment;

/**
 * Class YandexMoneyAdapter
 * @package App\Service\Payment\Adapters
 */
class YandexMoneyAdapter implements AdapterInterface
{

    /**
     * @param Payment $payment
     * @return array
     */
    public function pay(Payment $payment): array
    {
        try {

        } catch (\Throwable $e) {

        }
    }

    /**
     * @param Payment $payment
     * @return int
     */
    public function payStatus(Payment $payment): int
    {
        // TODO: Implement payStatus() method.
    }

    /**
     * @return string
     */
    public function adapterName(): string
    {
        // TODO: Implement adapterName() method.
    }
}
