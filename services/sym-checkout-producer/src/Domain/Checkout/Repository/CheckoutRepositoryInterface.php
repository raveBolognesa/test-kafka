<?php
declare(strict_types=1);
namespace App\Domain\Checkout\Repository;

use App\Domain\Checkout\Model\CheckoutModel;

interface CheckoutRepositoryInterface
{
    public function save(CheckoutModel $checkoutModel): CheckoutModel;
}