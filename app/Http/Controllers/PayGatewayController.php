<?php declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Requests\Pay\PayLinkRequest;
use Symfony\Component\HttpFoundation\Response;

class PayGatewayController
{
    /**
     * @param PayLinkRequest $request
     * @return Response
     */
    public function payLink(PayLinkRequest $request) : Response
    {

    }
}
