<?php
declare(strict_types=1);
namespace Sitegeist\Bitzer\Domain\Task\Generic;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Psr\Http\Message\UriInterface;
use Sitegeist\Bitzer\Domain\Task\ActionStatusType;
use Sitegeist\Bitzer\Domain\Task\NodeAddress;
use Sitegeist\Bitzer\Domain\Task\TaskIdentifier;
use Sitegeist\Bitzer\Domain\Task\TaskInterface;

/**
 * The task identifier value object
 * @Flow\Proxy(false)
 */
final class GenericTask implements TaskInterface
{
    /**
     * @var TaskIdentifier
     */
    private $identifier;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTimeImmutable
     */
    private $scheduledTime;

    /**
     * @var ActionStatusType
     */
    private $actionStatus;

    /**
     * @var string
     */
    private $agent;

    /**
     * @var UriInterface|null
     */
    private $target;

    /**
     * GenericTask constructor.
     * @param TaskIdentifier $identifier
     * @param string $description
     * @param \DateTimeImmutable $scheduledTime
     * @param ActionStatusType $actionStatus
     * @param string $agent
     * @param UriInterface $target
     */
    public function __construct(
        TaskIdentifier $identifier,
        string $description,
        \DateTimeImmutable $scheduledTime,
        ActionStatusType $actionStatus,
        string $agent,
        ?NodeAddress $object,
        ?UriInterface $target
    ) {
        $this->identifier = $identifier;
        $this->description = $description;
        $this->scheduledTime = $scheduledTime;
        $this->actionStatus = $actionStatus;
        $this->agent = $agent;
        $this->target = $target;
    }

    public static function getShortType(): string
    {
        return 'generic';
    }


    public function getIdentifier(): TaskIdentifier
    {
        return $this->identifier;
    }

    /**
     * The image describing the task. Must be a FontAwesome icon identifier available to the Neos UI.
     *
     * @return string
     */
    public function getImage(): string
    {
        return 'clipboard';
    }

    /**
     * A description of the task.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * The time the object is scheduled to.
     *
     * @return \DateTimeImmutable
     */
    public function getScheduledTime(): \DateTimeImmutable
    {
        return $this->scheduledTime;
    }

    /**
     * Indicates the current disposition of the Action.
     *
     * @return ActionStatusType
     */
    public function getActionStatus(): ActionStatusType
    {
        return $this->actionStatus;
    }

    /**
     * The direct performer or driver of the action (animate or inanimate). e.g. John wrote a book.
     * In our case, as tasks are assigned to user groups, this is a Flow policy role identifier.
     *
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * The object upon which the action is carried out, whose state is kept intact or changed.
     * Also known as the semantic roles patient, affected or undergoer (which change their state) or theme (which doesn't).
     *
     * For now, we expect that only nodes are affected by tasks, if at all.
     *
     * @return NodeInterface|null
     */
    public function getObject(): ?NodeInterface
    {
        return null;
    }

    /**
     * Indicates a target EntryPoint for an Action.
     *
     * In our case this is the URI for the next action to be done within this task.
     *
     * @return UriInterface|null
     */
    public function getTarget(): ?UriInterface
    {
        return $this->target;
    }
}
