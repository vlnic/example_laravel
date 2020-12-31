<?php declare(strict_types=1);

namespace App\Service\Payment\Adapters;

use App\Models\Payment;
use App\Service\Exception\PaymentServiceException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

/**
 * Class SberAdapter
 * @package App\Service\Payment\Adapters
 */
class SberAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    protected string $login;

    /**
     * @var string
     */
    protected string $pass;

    /**
     * @var string
     */
    protected string $restUrl;

    /**
     * @var Collection
     */
    protected Collection $endpoints;

    /**
     * SberAdapter constructor.
     * @param array $authData
     * @param string $restUrl
     * @param Collection $endpoints
     */
    public function __construct(array $authData, string $restUrl, Collection $endpoints)
    {
        $this->login = $authData['login'];
        $this->pass = $authData['pass'];
        $this->restUrl = $restUrl;
        $this->endpoints = $endpoints;
    }
    /**
     * @inheritDoc
     */
    public function pay(Payment $payment): array
    {
        try {
            $request = new Request('POST', $this->endpoints->get('createOrder'), [], ['']);
            $response = (new Client([
                'base_url' => $this->restUrl,
                'allow_redirects' => false
            ]))->send($request);
            $body = json_decode($response->getBody(), true, 512, JSON_OBJECT_AS_ARRAY);
        } catch (BadResponseException | GuzzleException $e) {
            if ($e->hasResponse()) {
                throw new \RuntimeException(
                    sprintf('incorrect request, response: %s', $e->getResponse()->getBody())
                );
            }
        }
        return [
            'external_id' => $body['orderId'],
            'payLink' => $body['link'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function payStatus(Payment $payment): int
    {
        try {
            $request = new Request('GET', $this->endpoints->get('orderStatus'), [], []);
            $response = (new Client([
                'base_url' => $this->restUrl,
                'allow_redirects' => false
            ]))->send($request);
            $body = json_decode($response->getBody(), true, 512, JSON_OBJECT_AS_ARRAY);
        } catch (\Throwable $e) {

        }
        return 0;
    }
}
