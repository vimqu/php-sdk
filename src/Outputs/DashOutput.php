<?php

namespace Vimqu\Vimqu\Outputs;

use Vimqu\Vimqu\Enums\OutputTypeEnum;

class DashOutput extends AbstractAdaptiveBitrate
{
    public function getType(): OutputTypeEnum
    {
        return OutputTypeEnum::DASH;
    }
}