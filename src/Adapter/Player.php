<?php

declare(strict_types=1);

namespace App\Adapter;

final class Player
{
    private string $id;
    private string $username;
    private string $score;
    private int $createdAt;

    public function __construct(string $id, string $username, string $score, int $createdAt)
    {
        $this->id = $id;
        $this->username = $username;
        $this->score = $score;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getScore(): string
    {
        return $this->score;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }
}
