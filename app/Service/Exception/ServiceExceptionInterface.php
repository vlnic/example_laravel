<?php declare(strict_types=1);

namespace App\Service\Exception;

use Throwable;

/**
 * Interface ServiceExceptionInterface
 */
interface ServiceExceptionInterface extends Throwable
{
    /**
     * @return string
     */
    public function serviceName() : string;

    /**
     * @return string
     */
    public function serviceClass() : string;
}
