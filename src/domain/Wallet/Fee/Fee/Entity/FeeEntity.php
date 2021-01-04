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
     * @var array
     */
    private $regions;

    /**
     * @var array
     */
    private $walletOrganizations;

    /**
     * @var SpecEntityInterface
     */
    private $fees;

    /**
     * @var int
     */
    public $createdAt;

    /**
     * OrganizationEntity constructor.
     * @param string|null $feeId
     * @param string|null $paymentMean
     * @param array|null $regions
     * @param array|null $walletOrganizations
     * @param array|null $fees
     * @param int|null $createdAt
     */
    public function __construct(
        ?string $feeId = null,
        ?string $paymentMean = null,
        ?array $regions = null,
        ?array $walletOrganizations = null,
        ?array $fees = null,
        int $createdAt = null
    ){
        $this->feeId = $feeId;
        $this->paymentMean = $paymentMean;
        $this->regions = $regions;
        $this->walletOrganizations = $walletOrganizations;
        $this->fees = $fees;
        $this->createdAt = $createdAt;
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
            $data['regions'] ?? null,
            $data['walletOrganizations'] ?? null,
            $data['fees'] ?? null,
            $data['createdAt'] ?? null

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
            'regions' => $this->regions,
            'walletOrganizations' => $this->walletOrganizations,
            'fees'=> $this->fees,
            'createdAt' => $this->createdAt
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
     * @return array
     */
    public function getRegions(): array
    {
        return $this->regions;
    }


    /**
     * @return SpecEntityInterface
     */
    public function getFees(): SpecEntityInterface
    {
        return $this->fees;
    }


}
