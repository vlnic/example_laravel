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
            $client = new Client([
                'base_url' => $this->restUrl,
                'allow_redirects' => false
            ]);
            $request = new Request('POST', $this->endpoints->get('createOrder'), [], ['']);
            $response = $client->send($request);
        } catch (BadResponseException | GuzzleException $e) {
            if ($e->hasResponse()) {
                throw new \RuntimeException(
                    sprintf('incorrect request, response: %s', $e->getResponse()->getBody())
                );
            }
        } catch (\Exception $e) {

        }
        return [];
    }

    /**
     * @inheritDoc
     */
    public function payStatus(Payment $payment): int
    {
        // TODO: Implement payStatus() method.
    }
}
