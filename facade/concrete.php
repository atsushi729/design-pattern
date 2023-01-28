<?php

namespace Facade;

class YouTubeDownloader
{
    protected $youtube;
    protected $ffmpeg;

    public function __cosntruct(string $youtubeApiKey)
    {
        $this->youtube = new YouTube($youtubeApiKey);
        $this->ffmpeg = new FFMpeg();
    }

    public function downloadVideo(string $url): void
    {
        echo "Fetching video metadata from youtube...\n";
        echo "Saving video file to a temporary file...\n";

        echo "Processing source video...\n";
        echo "Normalizing and resizing the video to smaller dimensions...\n";

        echo "Capturing preview image...\n";

        echo "Saving video in target formats...\n";

        echo "Done!\n";
    }
}

class YouTube
{
    public function fetchVideo(): string {}

    public function saveAs(string $path): string {}
}

class FFMpeg
{
    public static function create(): FFMpeg {}

    public function open(string $video): void {}
}

class FFMpegVideo
{
    public function filters(): self {}

    public function resize(): self {}

    public function synchronize(): self {}

    public function frame(): self {}

    public function save(string $path): self {}
}

function clientCode(YouTubeDownloader $facade)
{
    $facade->downloadVideo("https://www.youtube.com/watch?v=QH2-TGUlwu4");
}

$facade = new YouTubeDownloader("APIKEY-XXXXXXXXX");
clientCode($facade);