<?php

namespace Vimqu\Vimqu\Enums;

enum ClientEnum: string
{
    case BASE_URL = 'https://vimqu.com';

    case USER_AGENT = 'PHP-SDK v1.0.0';

    case STORAGE_ENDPOINT = 'storages';

    case TASK_SEARCH_ENDPOINT = 'task/search';

    case TASK_RESULT_ENPOINT = 'task';

    public function url()
    {
        return sprintf('%s/api/%s', self::BASE_URL->value, $this->value);
    }
}