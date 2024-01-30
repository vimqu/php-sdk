<?php

namespace Vimqu\Vimqu;

use Vimqu\Vimqu\Dto\FileDto;
use Vimqu\Vimqu\Dto\OutputDto;
use Vimqu\Vimqu\Dto\StorageDto;
use Vimqu\Vimqu\Dto\TaskDto;
use DateTime;

trait HasTaskDto
{
    private function toDto(array $rawTask): TaskDto
    {
        $taskDto = (new TaskDto)
        ->setId($rawTask['id'])
        ->setStatus($rawTask['status'])
        ->setCreatedAt(
            DateTime::createFromFormat('Y-m-d H:i:s', $rawTask['created_at'])
        );

        foreach($rawTask['outputs'] as $output) {
            $outputDto = (new OutputDto)
                ->setId($output['id'])
                ->setReferenceId($output['reference_id'])
                ->setStorage(
                    (new StorageDto)
                        ->setId($output['storage']['id'])
                        ->setName($output['storage']['name'])
                        ->setDriver($output['storage']['driver'])
                )
                ->setType($output['type'])
                ->setTypeSpecificConfig($output['type_specific_config']);

            $this->createFileDto($outputDto, $output);
            $taskDto->addOutput($outputDto);
        }

        return $taskDto;
    }


    private function createFileDto(OutputDto &$outputDto, array $output): void
    {
        foreach ($output['files'] as $file) {

            $fileDto = (new FileDto)->setPath($file['path']);

            $uploadedAt = empty($file['uploaded_at']) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $file['uploaded_at']);
            $fileDto->setUploadedAt($uploadedAt);

            $outputDto->addFile($fileDto);
        }
    }
}