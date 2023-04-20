<?php


namespace Wallet\Wallet\Account\Service;


use DateTimeInterface;
use GPBMetadata\Google\Api\Expr\V1Alpha1\Value;
use Wallet\Wallet\Account\Entity\TransactionEntity;
use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventFilterEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;
use Wallet\Wallet\Event\Service\EventServiceInterface;

class AccountTransactionService implements AccountTransactionServiceInterface
{

    /**
     * @var EventServiceInterface
     */
    protected $eventService;

    const T_CREDIT = "AccountBalanceOperation::Credit";
    const T_DEBIT = "AccountBalanceOperation::Debit";

    const CREDIT = "CREDIT";
    const DEBIT = "DEBIT";

    /**
     * AccountTransactionService constructor.
     * @param EventServiceInterface $eventService
     */
    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @inheritDoc
     */
    public function fetchWithAccountIdAndDateRange(
        EventFilterEntityInterface $eventFilterEntity
    ) : EventPaginationEntityInterface {

        $eventPaginationEntity = $this
            ->eventService
            ->fetchWithCriteriaAndDateRange(
                $eventFilterEntity
            );

        $eventPaginationEntity->setWalletAccountTransactions( array_map(function (array $event) {
            $type = in_array(self::T_CREDIT, $event['actions']) ? self::CREDIT :self::DEBIT;

            return [
                'action' => $event['actions'] ?? [],
                'type' => $type,
                'amount' => $event['data']['amount'] ?? null,
                'description' => $event['description'] ?? null,
                'datetime' => $event['timestamp'] ?? null,
                'transactionId' => $event['eventId'] ?? null
            ];
        }, $eventPaginationEntity->getWalletAccountTransactions()));


        return $eventPaginationEntity;
    }

    /**
     * @inheritDoc
     */
    public function create(TransactionEntity $transactionEntity): EventEntityInterface
    {
        return $this
            ->eventService
            ->create(
                EventEntity::fromArray(
                    [
                        'originator' => $transactionEntity->getOriginator(),
                        'originatorId' => $transactionEntity->getOriginatorId(),
                        'entity' => 'WalletAccount',
                        'entityId' => $transactionEntity->getAccountId(),
                        'actions' => [
                            'AccountBalanceOperation',
                            'AccountOperation',
                            sprintf('AccountBalanceOperation::%s', $transactionEntity->getTransactionType())
                        ],
                        'description' => $transactionEntity->getDescription(),
                        'timestamp' => time(),
                        'data' => [
                            'amount' => $transactionEntity->getAmount(),
                            'user' => $transactionEntity->getUserId()
                        ]
                    ]
                )
            );
    }
}
