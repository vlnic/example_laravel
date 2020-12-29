<?php declare(strict_types=1);

namespace App\Service\Exception;

use App\Service\PaymentService;
use Exception;

/**
 * Class PaymentServiceException
 */
class PaymentServiceException extends Exception implements ServiceExceptionInterface
{

    /**
     * @return string
     */
    public function serviceName(): string
    {
        return 'Payment service';
    }

    /**
     * @return string
     */
    public function serviceClass(): string
    {
        return PaymentService::class;
    }
}
