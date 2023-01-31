<?php

namespace App\Domain\Checkout\Factory;

use App\Domain\Checkout\Model\CheckoutModel;
use Symfony\Component\HttpFoundation\Request;

class CheckoutModelFactory
{

    public function fromRequest(Request $request): CheckoutModel
    {
        return CheckoutModel::fromRequest($request);
    }
}