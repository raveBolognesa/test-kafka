<?php

declare(strict_types=1);

namespace App\Application\Checkout\Service;

use App\Domain\Checkout\Entity\CheckoutInvoice;
use App\Domain\Checkout\Repository\CheckoutInvoiceRepositoryInterface;
use App\Infrastructure\Checkout\Repository\CheckoutInvoiceRepository;
use Doctrine\Persistence\ManagerRegistry;

class CreateCheckoutInvoiceOnCheckoutService
{
    public function __construct(
        private CheckoutInvoiceRepositoryInterface $repository
    ) {
    }
    public function createCheckoutInvoice(string $data): void {
        $checkoutInvoice = new CheckoutInvoice();
        $checkoutInvoice->createFromData($data);
        $this->repository->save($checkoutInvoice, true);
    }
}