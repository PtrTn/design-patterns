<?php

declare(strict_types=1);

namespace App\Adapter;

use DateTimeImmutable;
use InvalidArgumentException;

final class PlayerDto
{
    public int $id;
    public string $username;
    public int $score;
    public DateTimeImmutable $createdAt;

    public function __construct(int $id, string $username, int $score, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->username = $username;
        $this->score = $score;
        $this->createdAt = $createdAt;
    }

    public static function fromPlayer(Player $player): self
    {
        $createdAt = DateTimeImmutable::createFromFormat('U', $player->getCreatedAt());
        if ($createdAt === false) {
            throw new InvalidArgumentException('Invalid player created');
        }
        if (!is_numeric($player->getId())) {
            throw new InvalidArgumentException('Invalid player id');
        }
        if (!is_numeric($player->getScore())) {
            throw new InvalidArgumentException('Invalid player id');
        }

        return new self(
            intval($player->getId()),
            $player->getUsername(),
            intval($player->getScore()),
            $createdAt
        );
    }
}
