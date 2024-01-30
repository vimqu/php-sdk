<?php

namespace Vimqu\Vimqu\Task;

use DateTime;
use Vimqu\Vimqu\Dto\TaskDto;
use Vimqu\Vimqu\Enums\ClientEnum;
use Vimqu\Vimqu\HasClient;
use Vimqu\Vimqu\HasTaskDto;
use Vimqu\Vimqu\Outputs\AbstractOutput;


class TaskManager
{
    use HasClient, HasTaskDto;

    protected array $outputs = [];

    protected array $input = [];

    private array $task = [];

    /**
     * @param string $uuid ID of Storage
     * @param string $absoluteFilePath path to file exmp: /inputs/birds.mp4
     */
    public function setInputFromStorage(string $uuid, string $absoluteFilePath): self
    {
        $this->input = [
            'source_type' => 'storage',
            'storage_id' => $uuid,
            'path' => $absoluteFilePath
        ];

        return $this;
    }

    /**
     * @param string $url
     */
    public function setInputFromUrl(string $url): self
    {
        $this->input = [
            'source_type' => 'url',
            'path' => $url
        ];

        return $this;
    }

    public function addOutput(AbstractOutput $output): self
    {
        $this->outputs[] = $output;
        return $this;
    }

    private function prepareBody()
    {
        $this->task['input'] = $this->input;

        foreach($this->outputs as $output) {
            $this->task['outputs'][] = $output->prepare();
        }
    }

    public function send(): TaskDto
    {
        $this->prepareBody();

        $response = $this->getClient()->request('POST', ClientEnum::TASK_RESULT_ENPOINT->url(), [
            'form_params' => $this->task
        ]);

        $this->validateStatus($response);

        $rawTask = json_decode($response->getBody()->getContents(), true);

        return $this->toDto($rawTask['data']);
    }
}