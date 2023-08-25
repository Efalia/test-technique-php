<?php

declare(strict_types=1);

namespace App;

use Ramsey\Uuid\UuidInterface;

abstract class PièceIdentité
{
    private UuidInterface $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        return $this->id->toString();
    }
}
