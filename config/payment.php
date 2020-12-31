<?php
return [
  'adapters' => [
      'default' => env('DEFAULT_PAY_ADAPTER', 'yandex'),
      'yandex' => [
          'class' => \App\Service\Payment\Adapters\YandexMoneyAdapter::class,
          'api-key' => env('YANDEX_API_KEY', null),
      ],
      'sber' => [
          'class' => \App\Service\Payment\Adapters\SberAdapter::class,
          'login' => env('SBER_LOGIN', null),
          'password' => env('SBER_PASS', null),
          'restUrl' => env('APP_ENV') == 'prod' || env('APP_ENV') === 'production' ? 'https://' : 'https://3dsec.sberbank.ru/payment/rest',
          'endpoints' => [
              'createOrder' => '/register.do',
              'orderStatus' => '/getOrderStatusExtended.do',
          ]
      ]
  ],
];
