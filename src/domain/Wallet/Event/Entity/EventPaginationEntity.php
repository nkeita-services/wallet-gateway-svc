<?php


namespace Wallet\Wallet\Event\Entity;


class EventPaginationEntity implements EventPaginationEntityInterface
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $total;

    /**
     * @var array
     */
    private $walletAccountTransactions;


    /**
     * EventEntity constructor.
     * @param int|null $page
     * @param int|null $limit
     * @param int|null $total
     * @param array $walletAccountTransactions
     */
    public function __construct(
        ?int $page = null,
        ?int $limit = null,
        ?int $total = null,
        array $walletAccountTransactions = []
    ){
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
        $this->walletAccountTransactions = $walletAccountTransactions;
    }


    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): EventPaginationEntityInterface
    {
        return new static(
            $data['page'] ?? null,
            $data['limit'] ?? null,
            $data['total'] ?? null,
            $data['walletAccountTransactions'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'page' => $this->page,
            'limit' => $this->limit,
            'total' => $this->total,
            'walletAccountTransactions' =>$this->walletAccountTransactions,
        ];
    }


    /*** @inheritDoc */
    public function getPage(): int
    {
        return $this->page;
    }

    /*** @inheritDoc */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /*** @inheritDoc */
    public function getTotal(): int
    {
        return $this->total;
    }

    /*** @inheritDoc */
    public function getWalletAccountTransactions(): array
    {
        return $this->walletAccountTransactions;
    }

    /*** @inheritDoc */
    public function setWalletAccountTransactions(
        array $walletAccountTransactions
    ): EventPaginationEntityInterface
    {
        $this->walletAccountTransactions = $walletAccountTransactions;
        return $this;
    }
}
