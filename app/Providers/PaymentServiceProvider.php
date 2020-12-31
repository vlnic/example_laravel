<?php declare(strict_types=1);

namespace App\Providers;

use App\Service\Payment\Adapters\SberAdapter;
use App\Service\Payment\PaymentService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * Class PaymentServiceProvider
 * @package App\Providers
 */
class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $conf = config('payment');
        $this->app->register(SberAdapter::class, function (Application $app) use ($conf) {
            return new SberAdapter([
                'login' => $conf['sber']['login'],
                'pass' => $conf['sber']['pass']
            ], $conf['sber']['restUrl'], $conf['sber']['endpoints']);
        });
        $this->app->register(PaymentService::class, function (Application $app) use ($conf) {
            $adapters = Collection::make();
            foreach ($conf['adapters'] as $key => $value) {
                if ($key === 'default') {
                    $adapters->offsetSet($key, $app->make($conf['adapter'][$value]['class']));
                    continue;
                }
                $adapters->offsetSet($key, $app->make($value['class']));
            }
            return new PaymentService($adapters, $conf['adapters']['default']);
        });
    }

    public function boot() {}
}
