<?php


namespace Wallet\Wallet\Event\Entity;


class EventEntity implements EventEntityInterface
{
    /**
     * @var string
     */
    private $eventId;

    /**
     * @var string
     */
    private $originator;

    /**
     * @var string
     */
    private $originatorId;

    /**
     * @var int
     */
    private $timestamp;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $actions;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $entityId;

    /**
     * @var string
     */
    private $entity;

    /**
     * EventEntity constructor.
     * @param string $eventId
     * @param string $originator
     * @param string $originatorId
     * @param int $timestamp
     * @param array $data
     * @param array $actions
     * @param string $description
     * @param string $entityId
     * @param string $entity
     */
    public function __construct(
        ?string $eventId = null,
        ?string $originator = null,
        ?string $originatorId = null,
        ?int $timestamp = null,
        ?array $data = null,
        ?array $actions = null,
        ?string $description = null,
        ?string $entityId = null,
        ?string $entity = null
    ){
        $this->eventId = $eventId;
        $this->originator = $originator;
        $this->originatorId = $originatorId;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->actions = $actions;
        $this->description = $description;
        $this->entityId = $entityId;
        $this->entity = $entity;
    }


    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): EventEntityInterface
    {
        return new static(
            $data['eventId'] ?? null,
            $data['originator'] ?? null,
            $data['originatorId'] ?? null,
            $data['timestamp'] ?? null,
            $data['data'] ?? null,
            $data['actions'] ?? null,
            $data['description'] ?? null,
            $data['entityId'] ?? null,
            $data['entity'] ?? null

        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'eventId' => $this->eventId,
            'originator' => $this->originator,
            'originatorId'=>$this->originatorId,
            'entityId'=>$this->entityId,
            'entity'=>$this->entity,
            'timestamp'=>$this->timestamp,
            'data'=>$this->data,
            'actions'=>$this->actions,
            'description'=>$this->description
        ];
    }


    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function getOriginator(): string
    {
        return $this->originator;
    }

    /**
     * @return string
     */
    public function getOriginatorId(): string
    {
        return $this->originatorId;
    }

    /**
     * @return int
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getEntityId(): string
    {
        return $this->entityId;
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }
}
