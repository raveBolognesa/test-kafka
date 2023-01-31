<?php

namespace App\Domain\Checkout\Repository;

use App\Domain\Checkout\Entity\CheckoutInvoice;

interface CheckoutInvoiceRepositoryInterface
{

    public function save(CheckoutInvoice $entity, bool $flush = false): void;
}