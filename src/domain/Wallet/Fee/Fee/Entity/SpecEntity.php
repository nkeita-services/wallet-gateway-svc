<?php


namespace Wallet\Wallet\Fee\Fee\Entity;


class SpecEntity implements SpecEntityInterface
{
    /**
     * @var float
     */
    private $rate;

    /**
     * @var float
     */
    private $flatRate;


    /**
     * SpecEntity constructor.
     * @param float|null $rate
     * @param float $flatRate
     */
    public function __construct(
        ?float $rate= null,
        ?float $flatRate = null

    ){
        $this->rate = $rate;
        $this->flatRate = $flatRate;
    }
    /**
     * @param array $data
     * @return SpecEntityInterface
     */
    public static function fromArray(array $data): SpecEntityInterface
    {
        return new static(
            $data['rate'] ?? null,
            $data['flatRate'] ?? null,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'rate' => $this->rate,
            'flatRate' => $this->flatRate,
        ];
    }


    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getFlatRate(): float
    {
        return $this->flatRate;
    }
}
