<?php


namespace Wallet\Wallet\Plan\Entity;


class WalletPlanEntity implements WalletPlanEntityInterface
{

    /**
     * @var string
     */
    private $planId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var array
     */
    private $organizations;

    /**
     * @var string
     */
    private $status;

    /**
     * @var array
     */
    private $compliance;

    /**
     * WalletPlanEntity constructor.
     * @param string $planId
     * @param string $name
     * @param string $currency
     * @param array $organizations
     * @param string $status
     * @param array $compliance
     */
    public function __construct(
        ?string $planId,
        ?string $name,
        ?string $currency,
        ?array $organizations,
        ?string $status,
        ?array $compliance
    ){
        $this->planId = $planId;
        $this->name = $name;
        $this->currency = $currency;
        $this->organizations = $organizations;
        $this->status = $status;
        $this->compliance = $compliance;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(
        array $data
    ): WalletPlanEntityInterface{
        return new static(
            $data['planId'] ?? null,
            $data['name'] ?? null,
            $data['currency'] ?? null,
            $data['organizations'] ?? null,
            $data['status'] ?? null,
            $data['compliance'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            "planId"=> $this->planId,
            "name"=> $this->name,
            "currency"=>$this->currency,
            "status"=>$this->status,
            "compliance"=>$this->compliance,
            'organizations'=>$this->organizations
        ];
    }

}
