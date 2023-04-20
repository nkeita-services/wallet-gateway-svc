<?php


namespace Wallet\Wallet\Event\Entity;


class EventFilterEntity implements EventFilterEntityInterface
{

    /**
     * @var string
     */
    private $entityId;

    /**
     * @var string
     */
    private $entity;

    /**
     * @var array
     */
    private $actions;

    /**
     * @var int
     */
    private $fromTimestamp;

    /**
     * @var int
     */
    private $toTimestamp;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    /**
     * EventEntity constructor.
     * @param string $entityId
     * @param string $entity
     * @param array $actions
     * @param int|null $fromTimestamp
     * @param int|null $toTimestamp
     * @param int|null $page
     * @param int|null $limit
     */
    public function __construct(
        ?string $entityId = null,
        ?string $entity = null,
        ?array $actions = null,
        ?int $fromTimestamp = null,
        ?int $toTimestamp = null,
        ?int $page = null,
        ?int $limit = null
    ){
        $this->entityId = $entityId;
        $this->entity = $entity;
        $this->actions = $actions;
        $this->fromTimestamp = $fromTimestamp;
        $this->toTimestamp = $toTimestamp;
        $this->page = $page;
        $this->limit = $limit;
    }


    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): EventFilterEntityInterface
    {
        return new static(
            $data['entityId'] ?? null,
            $data['entity'] ?? null,
            $data['actions'] ?? null,
            $data['fromTimestamp'] ?? null,
            $data['toTimestamp'] ?? null,
            $data['page'] ?? null,
            $data['limit'] ?? null,
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $filtersData = [
            'entityId' => $this->entityId,
            'entity' => $this->entity,
            'actions'=>$this->actions,
            'fromTimestamp'=>$this->fromTimestamp,
            'toTimestamp'=>$this->toTimestamp,
            'page'=>$this->page,
            'limit'=>$this->limit,
        ];

        return array_filter(
            $filtersData,
            function ($propertyValue, $propertyName){
                return $propertyValue !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
