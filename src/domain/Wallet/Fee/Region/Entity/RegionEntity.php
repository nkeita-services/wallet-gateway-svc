<?php


namespace Wallet\Wallet\Fee\Region\Entity;


class RegionEntity implements RegionEntityInterface
{
    /**
     * @var string
     */
    private $regionId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $walletOrganizations;

    /**
     * @var array
     */
    private $countryCodes;

    /**
     * RegionEntity constructor.
     * @param string $regionId
     * @param string $name
     * @param array|null $walletOrganizations
     * @param array $countryCodes
     */
    public function __construct(
        ?string $regionId,
        ?string $name,
        ?array $walletOrganizations,
        ?array $countryCodes
    ){
        $this->regionId = $regionId;
        $this->name = $name;
        $this->walletOrganizations = $walletOrganizations;
        $this->countryCodes = $countryCodes;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(
        array $data
    ): RegionEntityInterface{
        return new static(
            $data['regionId'] ?? null,
            $data['name'] ?? null,
            $data['walletOrganizations'] ?? null,
            $data['countryCodes'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $planData =  [
            "regionId"=> $this->regionId,
            "name"=> $this->name,
            'walletOrganizations'=>$this->walletOrganizations,
            "countryCodes"=>$this->countryCodes,
        ];

        return array_filter(
            $planData,
            function ($propertyValue, $propertyName){
                return $propertyValue !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
