<?php

namespace Vimqu\Vimqu\Dto;

use Datetime;

class OutputDto
{
    private string $id;

    private string $referenceId;

    private StorageDto $storageDto;

    private string $type;

    private array $typeSpecificConfig;

    private array $files = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getReferenceId(): ?string
    {
        return $this->referenceId;
    }

    public function setReferenceId(?string $referenceId): self
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    public function getStorage(): StorageDto
    {
        return $this->storageDto;
    }

    public function setStorage(StorageDto $storageDto): self
    {
        $this->storageDto = $storageDto;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getTypeSpecificConfig(): array
    {
        return $this->typeSpecificConfig;
    }

    public function setTypeSpecificConfig(array $typeSpecificConfig): self
    {
        $this->typeSpecificConfig = $typeSpecificConfig;
        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function addFile(FileDto $file): self
    {
        $this->files[] = $file;
        return $this;
    }
}
