<?php declare(strict_types=1);

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PayLinkRequest
 */
class PayLinkRequest extends FormRequest
{
    public function rules()
    {
        return [
          'email' => 'required|email',
          'sum' => 'required|numeric',
          'product.' => ''
        ];
    }
}
