<?php
declare(strict_types=1);
namespace App\Domain\Checkout\Request;

use Symfony\Component\HttpFoundation\Request;

class CheckoutRequest
{

    public const DEFAULT_ITEM = 'default_item';

    private \DateTime $time;
    public function __construct(
        private string $item
    ){
        $this->time = new \DateTime();
    }

    public function getItem(): string {
        return $this->item;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }
   public static function fromRequest(Request $request): self
   {
       /** @var string $json */
       $json= $request->getContent();
       try {
           $array = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
           return new self($array['item'] ?? self::DEFAULT_ITEM);
       } catch (\JsonException $exception) {
           throw new \Exception($exception->getMessage());
       }
   }
}