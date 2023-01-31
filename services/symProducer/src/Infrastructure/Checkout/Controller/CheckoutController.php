<?php

declare(strict_types=1);

namespace App\Infrastructure\Checkout\Controller;

use App\Application\Checkout\Service\CheckoutService;
use App\Domain\Checkout\Request\CheckoutRequest;
use App\Infrastructure\Checkout\Producer\CheckoutProducer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    public function __construct(
        private CheckoutService $checkoutService,
        private CheckoutProducer $checkoutProducer,
    ){}

    #[Route('/checkout', name: 'app_checkout', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        try {

            $model = $this->checkoutService->create(CheckoutRequest::fromRequest($request));
            $this->checkoutProducer->produce($model)->flush();
            return $this->json([
                'message' => $model->getItem(),
                'path' => 'src/Controller/ConferenceController.php',
            ]);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

}