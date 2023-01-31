<?php

declare(strict_types=1);

namespace App\Infrastructure\Checkout\Controller;

use App\Application\Checkout\Service\CheckoutService;
use App\Domain\Checkout\Request\CheckoutRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    public function __construct(
        private CheckoutService $checkoutService,
    ){}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/checkout', name: 'app_checkout', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->json(
                $this->checkoutService->create(
                    CheckoutRequest::fromRequest($request)
                )->toArray()
            );
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

}