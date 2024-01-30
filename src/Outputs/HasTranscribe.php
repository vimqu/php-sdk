<?php

namespace Vimqu\Vimqu\Outputs;

trait HasTranscribe
{
    protected bool $transcribe = false;

    public function transcribe(bool $transcribe): self
    {
        $this->transcribe = $transcribe;

        return $this;
    }
}