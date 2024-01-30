<?php

namespace Vimqu\Vimqu\Task;

use Vimqu\Vimqu\Dto\TaskDto;
use Vimqu\Vimqu\Enums\ClientEnum;
use Vimqu\Vimqu\HasClient;
use Vimqu\Vimqu\HasTaskDto;

class Search
{
    use HasClient, HasTaskDto;

    /**
     * @var $types array|null
     * @var string|null $referenceId
     * @var string|null $status
     * @var string|null $page
     * @var string|null $asDto
     */
    public function search(?array $types = [], ?string $referenceId = null, ?string $status = null, ?int $page = 1, bool $asDto = true): array
    {
        $taskCollection = [];

        do {

            $response = $this->getClient()->request('GET', ClientEnum::TASK_SEARCH_ENDPOINT->url(), [
                'query' => [
                    'type' => $types,
                    'reference_id' => $referenceId,
                    'status' => $status,
                    'page' => $page
                ]
            ]);

            $this->validateStatus($response);

            $tasks = json_decode($response->getBody()->getContents(), true);

            foreach($tasks['data'] as $task) {

                $taskCollection[] = $asDto ? $this->toDto($task) : $task;
            }

            ++$page;

        } while ($tasks['links']['next'] !== null);


        return $taskCollection;
    }


    /**
     * @return TaskDto
     */
    public function getById(string $taskUuid): TaskDto
    {
        $url = sprintf('%s/%s', ClientEnum::TASK_RESULT_ENPOINT->url(), $taskUuid);
        $response = $this->getClient()->request('GET', $url);

        $this->validateStatus($response);

        $task = json_decode($response->getBody()->getContents(), true);

        return $this->toDto($task['data']);
    }
}