<p align="center" width="100%">
	<img src="https://vimqu.com/web/images/vimqu_org_400.png">
</p>

# VimQu PHP-SDK

With this SDK you can change the container (mp4, mkv, mov, webm), codec (h264, h265, vp8, vp9, prores) and bitrate of video files. You can create **Adaptive Bitrate** videos. While doing this, you can **resize**, **crop**, **clip** operations on the video. You can create **thumbnails** from video file. Create subtitle files (**WebVTT**, **SRT**) in 94 languages (AI generated). Uploads the output files to the storage service of your choice.

Currently, VimQu is integrated with the following storage services:
- AWS S3
- Google Cloud Storage 
- Azure Storage
- FTP
- Any S3 Compatible Service like Vultr Object Storage, DigitalOcean Object Storage, Wasabi, Backblaze ...

[See Full documentation](https://doc.vimqu.com/).

# Requirements
- PHP 8.1+
- VimQu Account. [Create account](https://vimqu.com/register)
- VimQu Token.
- Storage Service (you have to save it in VimQu). You can create it in [this page](https://vimqu.com/board/my-storages) and you can find how to add storage [in this page](https://doc.vimqu.com/category/storage-configuration)

# Installation

    composer require vimqu/php-sdk

# Quick Start
To create a Task we need a TaskManager instance. 
```php
use Vimqu\Vimqu\Task\TaskManager;
use Vimqu\Vimqu\Outputs\VideoOutput;

$task = TaskManager::withToken('your_access_token')
    ->setInputFromStorage('your_storage_id', '/birds.mp4');
	// or
    ->setInputFromUrl('https://<your_file>.mp4');

$video = (new VideoOutput('h264', 'mp4'))
    ->setStorage('your_storage_id', '/outputs/videos')
    ->setReferenceId('your_reference_id')
    ->subtitle(true)
    ->resize(300, null)
    ->clip(2, duration: 45)
    ->crop(300, 300, 15, 15);

$task->addOutput($video);
$result = $task->send();
```
You can add more than one output. If there is no error, the result will be the `Vimqu\Vimqu\Dto\TaskDto` instance.

```php
$status = $result->getStatus(); // the status will be "active".
$id = $result->getId(); 
```
We will send you a **request (webhook)** when the task is complete. However, you can get the task result at any time.
```php
use Vimqu\Vimqu\Task\Search;

// This query will give you the "TaskDto" instance again.
$task = Search::withToken('xxxx xxxx')->getById($id);

```

# Task
[API Document](https://doc.vimqu.com/category/task-service)
## Create HLS
```php
use Vimqu\Vimqu\Outputs\HlsOutput;

$hls = (new HlsOutput)
    ->setStorage('your_storage_id', '/outputs/hls')
    ->setReferenceId('your_reference_id')
    ->subtitle(true)
    ->clip(2, 45)
    ->crop(300, 300, 15, 15)
    ->overlayImage('https://your_overlay_image.png', 50, 50, 0, 20)
    ->addVariant('240p')
    ->addVariant('480p')
    ->addVariant('720p')
    ->addVariant('1080p');

// $task is instance of TaskManager, we created it before.
$task->addOutput($hls);
$task->send();
```
- **Available variants**:  240p, 360p, 480p, 720p, 1080p, 1440p, 2160p
- **Available filters**: clip, crop, subtitle, overlayImage

## Create Mpeg DASH
```php
use Vimqu\Vimqu\Outputs\DashOutput;

$dash = (new DashOutput)
    ->setStorage('your_storage_id', '/outputs/dash')
    ->setReferenceId('your_reference_id')
    ->subtitle(true)
    ->clip(2, 45)
    ->crop(300, 300, 15, 15)
    ->addVariant('720p')
    ->addVariant('1080p');

$task->addOutput($dash);
$task->send();
```
- **Available variants**:  240p, 360p 480p, 720p, 1080p, 1440p, 2160p
- **Available filters**: clip, crop, subtitle, overlayImage

## Create Video Output
```php
use Vimqu\Vimqu\Outputs\VideoOutput;

$video = (new VideoOutput('h264', 'mp4'))
    ->setStorage('your_storage_id', '/outputs/videos')
    ->setReferenceId('your_reference_id')
    ->subtitle(true)
    ->resize(300, null)
    ->clip(2, duration: 45)
    ->crop(300, 300, 15, 15);

$task->addOutput($video);
$task->send();
```
- **Available containers**: mp4, webm, mov, mkv
- **Available video codecs**: h264, h265, vp8, vp9, prores
- **Available filters**: resize, clip, crop, subtitle, overlayImage

## Create Thumbnail with Exact Seconds
```php
use Vimqu\Vimqu\Outputs\ThumbnailBySeconds;

$thumbnailBySeconds = (new ThumbnailBySeconds([4, 22, 400, 650]))
    ->setStorage('your_storage_id', '/outputs/thumbnails/seconds')
    ->setReferenceId('your_reference_id')
    ->resize(300, null);

$task->addOutput($thumbnailBySeconds);
$task->send();
```
- **Available containers**: jpg, png, webp
- **Available filters**: resize

## Create Thumbnail with Number
```php
use Vimqu\Vimqu\Outputs\ThumbnailByNumber;

$thumbnailByNumber = (new ThumbnailByNumber(5, 'jpg'))
    ->setStorage('your_storage_id', '/outputs/thumbnails/number')
    ->setReferenceId('your_reference_id')
    ->resize(300, 500, true);

$task->addOutput($thumbnailByNumber);
$task->send();
```
- **Available containers**: jpg, png, webp
- **Available filters**: resize

## Create Thumbnail with Interval
```php
use Vimqu\Vimqu\Outputs\ThumbnailByInterval;

$thumbnailByInterval = (new ThumbnailByInterval(10, 'png'))
    ->setStorage('your_storage_id', '/outputs/thumbnails/interval')
    ->setReferenceId('your_reference_id')
    ->resize(null, 150);

$task->addOutput($thumbnailByInterval);
$task->send();
```
- **Available containers**: jpg, png, webp
- **Available filters**: resize
# Storage
You can fetch all storages. [Details](https://doc.vimqu.com/category/storage-configuration)
```php
use Vimqu\Vimqu\Storage;

$storages = Storage::withToken($token)->all();
// [
//    [
//         'name' => 'my_storage',
//         'id' => 'xxxx xxxx xxxx',
//         'driver' => 's3' // it can be ftp, gcs, azure
//    ]
// ]
```

## Search Task
This method will get you all your tasks. The result is an array of TaskDto.
```php
use Vimqu\Vimqu\Task\Search;

$tasks = Search::withToken($token)->search();
```
You can apply these filters:
```php
$tasks = Search::withToken($token)->search(
	['hls', 'thumbnail', 'dash'],
	'your_reference_id',
	'completed'
);
```
### Result of the Search (the TaskDto)
```php
foreach($tasks as $task) {

    $taskStatus = $task->getStatus();
    $id = $task->getId();

    foreach($task->getOutputs() as $output) {

        $reference = $output->getReferenceId();

        foreach($output->getFiles() as $file){
            $filePath = $file->getPath();
        }
    }
}
```

- [Vimqu\Vimqu\Dto\FileDto](https://github.com/vimqu/php-sdk/blob/main/src/Dto/FileDto.php)
- [Vimqu\Vimqu\Dto\OutputDto](https://github.com/vimqu/php-sdk/blob/main/src/Dto/OutputDto.php)
- [Vimqu\Vimqu\Dto\TaskDto](https://github.com/vimqu/php-sdk/blob/main/src/Dto/TaskDto.php)

# Filters Reference
## resize
You can use it to rescale the video.

|  Parameter  |  Nullable  | Type  | Default Value  |
| ------------ | ------------ | ------------ | ------------ |
|  width | YES | int | null |
|  height | YES | int | null |
|  aspectRatio | YES | bool | null |

## clip
You can create clips from any time in the video.

|  Parameter  |  Nullable  | Type  | Default Value  |
| ------------ | ------------ | ------------ | ------------ |
|  from | YES | int | null |
|  duration | YES | int | null |
|  to | YES | bool | null |

## overlayImage
You can use it to burn pictures on video.

|  Parameter  |  Nullable  | Type  | Default Value  |
| ------------ | ------------ | ------------ | ------------ |
|  url | YES | int | null |
|  coordinateX | YES | int | null |
|  coordinateY | YES | int | null |
|  firstSecond | YES | int | null |
|  lastSecond | YES | int | null |

## crop
You can cut the video at specific points.

|  Parameter  |  Nullable  | Type  | Default Value  |
| ------------ | ------------ | ------------ | ------------ |
|  width | NO | int | null |
|  height | NO | int | null |
|  coordinate_x | NO | int | null |
|  coordinate_y | NO | int | null |

## subtitle
You can use it to create a transcript. Your vtt and srt files will be in targetPath root directory. You gave this directory in the setStorage method.

|  Parameter  |  Nullable  | Type  | Default Value  |
| ------------ | ------------ | ------------ | ------------ |
|  subtitle | NO | bool | false |