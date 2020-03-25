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
     * @var string
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
     * EventEntity constructor.
     * @param string $eventId
     * @param string $originator
     * @param string $originatorId
     * @param string $timestamp
     * @param array $data
     * @param array $actions
     * @param string $description
     */
    public function __construct(
        ?string $eventId = null,
        ?string $originator = null,
        ?string $originatorId = null,
        ?string $timestamp = null,
        ?array $data = null,
        ?array $actions = null,
        ?string $description = null
    ){
        $this->eventId = $eventId;
        $this->originator = $originator;
        $this->originatorId = $originatorId;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->actions = $actions;
        $this->description = $description;
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
            $data['description'] ?? null
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
     * @return string
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

}
