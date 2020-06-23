<?php


namespace Wallet\Wallet\Transfer\Entity;


class TransferEntity implements TransferEntityInterface
{

    /**
     * @var string
     */
    public $transferId;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var array
     */
    public $sender;

    /**
     * @var array
     */
    public $receiver;

    /**
     * @var int
     */
    public $createdAt;

    /**
     * TransferEntity constructor.
     * @param string $transferId
     * @param float $amount
     * @param array $sender
     * @param array $receiver
     * @param int $createdAt
     */
    public function __construct(
        string $transferId = null,
        float $amount = null,
        array $sender = null,
        array $receiver = null,
        int $createdAt = null)
    {
        $this->transferId = $transferId;
        $this->amount = $amount;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->createdAt = $createdAt;
    }


    /**
     * @inheritDoc
     */
    public static function fromArray(
        array $data
    ): TransferEntityInterface
    {
        return new static(
            $data['transferId'] ?? null,
            $data['amount'] ?? null,
            $data['sender'] ?? null,
            $data['receiver'] ?? null,
            $data['createdAt'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'transferId' => $this->transferId,
            'amount' => $this->amount,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'createdAt' => $this->createdAt
        ];
    }


    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return array
     */
    public function getSender(): array
    {
        return $this->sender;
    }

    /**
     * @return array
     */
    public function getReceiver(): array
    {
        return $this->receiver;
    }

    /**
     * @inheritDoc
     */
    public function getBeneficiaryId(): string
    {
        return $this->receiver['beneficiaryId'];
    }

    /**
     * @inheritDoc
     */
    public function receiverAccountId(): string
    {
        return $this->receiver['accountId'];
    }

    /**
     * @inheritDoc
     */
    public function senderAccountId(): string
    {
        return $this->sender['accountId'];
    }


}
