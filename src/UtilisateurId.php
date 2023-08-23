<?php

declare(strict_types=1);

namespace App;

final class UtilisateurId
{
    const ALGO = 'sha256';

    public function __construct(
        private MotDePasse $motDePasse,
        private string $nomComplet,
    ) {
    }

    public function toMapKey(): string
    {
        return \hash(
            static::ALGO,
            \serialize($this)
        );
    }
}
