<?php declare(strict_types=1);

namespace App\Listeners;

use App\Listeners\FailedListenerTrait;

/**
 * Class PayLinkEventListener
 * @package App\Listeners
 */
class PayLinkEventListener
{
    use FailedListenerTrait;

    public function handle()
    {

    }
}
