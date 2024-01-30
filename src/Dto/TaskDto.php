<?php

namespace Vimqu\Vimqu\Dto;

use Datetime;

class TaskDto
{
    private string $id;

    private DateTime $createdAt;

    private string $status;

    private array $outputs;

    /**
     * Uuid of the Task
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Date format : Y-m-d H:i:s (UTC)
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * return can be active, processing, completed, failed, canceled
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Collection of OutputDto
     * @return array
     */
    public function getOutputs(): array
    {
        return $this->outputs;
    }

    public function addOutput(OutputDto $outputDto): self
    {
        $this->outputs[] = $outputDto;
        return $this;
    }
}