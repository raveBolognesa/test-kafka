<?php
declare(strict_types=1);

namespace App\Application\Checkout\Service;

use App\Domain\Checkout\Factory\CheckoutModelFactory;
use App\Domain\Checkout\Model\CheckoutModel;
use App\Domain\Checkout\Request\CheckoutRequest;
use App\Domain\Checkout\Repository\CheckoutRepositoryInterface;
use App\Domain\Checkout\Response\CheckoutResponse;

class CheckoutService
{

    public function __construct(
        private CheckoutModelFactory $checkoutModelFactory,
        private CheckoutRepositoryInterface $checkoutRepository
    )
    {}
    public function create(CheckoutRequest $request): CheckoutResponse
    {
        $model = $this->checkoutModelFactory->fromRequest($request);
        $this->checkoutRepository->save($model);
        return new CheckoutResponse($model->getItem(),$model->getTime());
    }

}