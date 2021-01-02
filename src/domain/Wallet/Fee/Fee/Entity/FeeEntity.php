<?php


namespace Wallet\Wallet\Fee\Fee\Entity;


class FeeEntity implements FeeEntityInterface
{

    /**
     * @var string
     */
    private $feeId;
    /**
     * @var string
     */
    private $paymentMean;

    /**
     * @var string
     */
    private $regionId;

    /**
     * @var array
     */
    private $walletOrganizations;

    /**
     * @var SpecEntityInterface
     */
    private $fees;

    /**
     * OrganizationEntity constructor.
     * @param string|null $feeId
     * @param string|null $paymentMean
     * @param string $regionId
     * @param array|null $walletOrganizations
     * @param array|null $fees
     */
    public function __construct(
        ?string $feeId = null,
        ?string $paymentMean = null,
        ?string $regionId = null,
        ?array $walletOrganizations = null,
        ?array $fees = null
    ){
        $this->feeId = $feeId;
        $this->paymentMean = $paymentMean;
        $this->regionId = $regionId;
        $this->walletOrganizations = $walletOrganizations;
        $this->fees = $fees;
    }

    /**
     * @param array $data
     * @return FeeEntityInterface
     */
    public static function fromArray(array $data): FeeEntityInterface
    {
        return new static(
            $data['feeId'] ?? null,
            $data['paymentMean'] ?? null,
            $data['regionId'] ?? null,
            $data['walletOrganizations'] ?? null,
            $data['fees'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'feeId' => $this->feeId,
            'paymentMean' => $this->paymentMean,
            'regionId' => $this->regionId,
            'walletOrganizations' => $this->walletOrganizations,
            'fees'=> $this->fees
        ];
    }

    /**
     * @return string
     */
    public function getFeeId(): string
    {
        return $this->feeId;
    }

    /**
     * @return string
     */
    public function getPaymentMean(): string
    {
        return $this->paymentMean;
    }

    /**
     * @return array
     */
    public function getWalletOrganizations(): array
    {
        return $this->walletOrganizations;
    }

    /**
     * @return string
     */
    public function getRegionId(): string
    {
        return $this->regionId;
    }


    /**
     * @return SpecEntityInterface
     */
    public function getFees(): SpecEntityInterface
    {
        return $this->fees;
    }

}
