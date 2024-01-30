<?php

namespace Vimqu\Vimqu\Enums;

enum OutputTypeEnum: string
{
    case THUMBNAIL = 'thumbnail';

    case VIDEO = 'video';

    case HLS = 'hls';

    case DASH = 'dash';
}