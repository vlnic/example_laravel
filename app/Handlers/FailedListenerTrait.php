<?php declare(strict_types=1);

namespace App\Handlers;

/**
 * Trait FailedListenerTrait
 * @package App\Listener
 */
trait FailedListenerTrait
{
    /**
     * @param $event
     * @param \Throwable $throwable
     */
    public function failed($event, \Throwable $throwable)
    {
        if (property_exists(self::class, 'logger')) {
            $this->logger->critical($throwable->getMessage(), $throwable->getTrace());
        }
        $event->setError($throwable);
    }
}
