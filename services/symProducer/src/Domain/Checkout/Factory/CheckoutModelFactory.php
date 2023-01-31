<?php

namespace App\Domain\Checkout\Factory;

use App\Domain\Checkout\Model\CheckoutModel;
use App\Domain\Checkout\Request\CheckoutRequest;
use Symfony\Component\HttpFoundation\Request;

class CheckoutModelFactory
{

    public function fromRequest(CheckoutRequest $request): CheckoutModel
    {
        return CheckoutModel::fromRequest($request);
    }
}