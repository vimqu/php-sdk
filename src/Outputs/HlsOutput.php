<?php

namespace Vimqu\Vimqu\Outputs;
use Vimqu\Vimqu\Enums\OutputTypeEnum;

class HlsOutput extends AbstractAdaptiveBitrate
{
    public function getType(): OutputTypeEnum
    {
        return OutputTypeEnum::HLS;
    }
}