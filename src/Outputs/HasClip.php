<?php

namespace Vimqu\Vimqu\Outputs;

trait HasClip
{
    protected ?array $clip = null;

    public function clip(int $from = 0, ?int $duration = null, ?int $to = null): self
    {
        $this->clip = [
            'from' => $from,
            'to' => $to,
            'duration' => $duration
        ];

        return $this;
    }
}