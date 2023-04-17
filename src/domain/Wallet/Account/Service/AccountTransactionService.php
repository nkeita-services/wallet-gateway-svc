<?php


namespace Wallet\Wallet\Account\Service;


use DateTimeInterface;
use GPBMetadata\Google\Api\Expr\V1Alpha1\Value;
use Wallet\Wallet\Account\Entity\TransactionEntity;
use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Service\EventServiceInterface;

class AccountTransactionService implements AccountTransactionServiceInterface
{

    /**
     * @var EventServiceInterface
     */
    protected $eventService;

    const CREDIT = "AccountBalanceOperation::Credit";

    const DEBIT = "AccountBalanceOperation::Debit";

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
        string $accountId,
        ?string $type,
        ?DateTimeInterface $fromDate = null,
        ?DateTimeInterface $toDate = null
    ) {
        $actions = ['AccountBalanceOperation'];

        if (in_array($type, ['Debit', 'Credit'])) {
            $actions = [
                sprintf('AccountBalanceOperation::%s', $type)
            ];
        }


        $eventCollection = $this
            ->eventService
            ->fetchWithCriteriaAndDateRange(
                [
                    'entityId' => $accountId,
                    'entity' => 'WalletAccount',
                    'actions' => $actions
                ],
                $fromDate instanceof DateTimeInterface ? $fromDate->getTimestamp() : null,
                $toDate instanceof DateTimeInterface ? $toDate->getTimestamp() : null
            );

        return array_map(function (array $event) {
            $action = $event['actions'];
            return [
                'action' => $event['actions'] ?? [],
                'type' => in_array(self::CREDIT, $event['actions']) ? "CREDIT" : "DEBIT",
                'amount' => $event['data']['amount'] ?? null,
                'description' => $event['description'] ?? null,
                'datetime' => $event['timestamp'] ?? null,
                'transactionId' => $event['eventId'] ?? null
            ];
        }, $eventCollection->toArray());
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
