<?php
declare(strict_types=1);

namespace Podfather\Techtest\Entity;

interface EntityInterface
{
    public function getId(): string;

    public function toArray(): array;

    public static function createFromArray(array $input): static;
}
