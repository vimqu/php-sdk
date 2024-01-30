<?php

namespace Vimqu\Vimqu\Dto;

use Datetime;

class FileDto
{
    private string $path;

    private ?DateTime $uploadedAt;

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getUploadedAt(): ?DateTime
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(?DateTime $uploadedAt): self
    {
        $this->uploadedAt = $uploadedAt;
        return $this;
    }
}
