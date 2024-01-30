<?php

namespace Vimqu\Vimqu\Outputs;

use Vimqu\Vimqu\Enums\OutputTypeEnum;

abstract class AbstractOutput
{
    protected string $storageId;

    protected string $targetPath;

    protected string $referenceId;

    /**
     * @param string $uuid ID of the Storage
     * @param string $absolutePath Absolute path to your output directory
     * @return self
     */
    public function setStorage(string $uuid, string $absolutePath): static
    {
        $this->storageId = $uuid;
        $this->targetPath = $absolutePath;

        return $this;
    }

    /**
     * @param string $referenceId
     * @return self
     */
    public function setReferenceId(string $referenceId): static
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    public function prepare(): array
    {
        return [
            'type' => $this->getType()->value,
            'storage_id' => $this->storageId,
            'target_path' => $this->targetPath,
            'reference_id' => $this->referenceId,
            'type_specific_config' => $this->getTypeSpecificConfig()
        ];
    }

    abstract protected function getType(): OutputTypeEnum;

    abstract protected function getTypeSpecificConfig(): array;
}