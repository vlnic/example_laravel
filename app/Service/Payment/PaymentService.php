<?php declare(strict_types=1);

namespace App\Service\Payment;

use App\Models\Payment;
use App\Service\Exception\PaymentServiceException;
use App\Service\Payment\Adapters\AdapterInterface;
use Illuminate\Support\Collection;

/**
 * Class PaymentService
 */
class PaymentService
{
    /**
     * @var Collection
     */
    protected Collection $adapters;

    /**
     * @var string
     */
    protected string $default;

    /**
     * PaymentService constructor.
     * @param Collection $adapters
     * @param string $default
     */
    public function __construct(Collection $adapters, string $default)
    {
        $this->adapters = $adapters;
        $this->default = $default;
    }

    /**
     * @param Payment $payment
     * @param string|null $adapterName
     * @return string
     * @throws PaymentServiceException
     */
    public function payLink(Payment $payment, string $adapterName = null) : string
    {
        try {
            $adapter = $this->resolve($adapterName);
            $data = $adapter->pay($payment);
            $payment->external_id = $data['external_id'];
            $payment->save();
        } catch (\Throwable $e) {
            throw new PaymentServiceException($e->getMessage(), $e->getCode(), $e);
        }
        return $data['payLink'];
    }

    /**
     * @param string|null $adapterName
     * @return AdapterInterface
     * @throws PaymentServiceException
     */
    private function resolve(string $adapterName = null) : AdapterInterface
    {
        $adapterName = $adapterName ?? $this->default;
        if (null === $adapter = $this->adapters->get($adapterName, null)) {
            throw new PaymentServiceException(sprintf('Adapter \'%s\' was not found!', $adapterName));
        }
        return $adapter;
    }
}
