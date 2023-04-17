<?php

namespace App\DTOs\ArticlesController;

use App\DTOs\AbstractDTO;

class StoreRequestDTO extends AbstractDTO
{
    protected int $teamId;
    protected string $title;
    protected string $text;
    protected string $thumbnail;

    public function __construct(
        int $teamId,
        string $title,
        string $text,
        ?string $thumbnail
    ) {
        $this->setTeamId($teamId);
        $this->setTitle($title);
        $this->setText($text);
        $this->setThumbnail($thumbnail);
    }

    private function setTeamId(int $teamId): void
    {
        $this->teamId = $teamId;
    }

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setText(string $text): void
    {
        $this->text = $text;
    }

    private function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }
}
