<?php

declare(strict_types=1);

namespace App;

use Innmind\Immutable\Map;
use Innmind\Immutable\Set;

enum Doigt
{
    case Pouce;
    case Index;
    case Majeur;
    case Annulaire;
    case Auriculaire;

    /**
     * Liste les variantes de l'enum sous la forme 
     * d'un `Innmind\Immutable\Set`
     */
    public static function toSet(): Set
    {
        return Set::of(...static::cases());
    }
}

final class EmpreintesDigitales
{
    private Map $doigts;

    /**
     * @param array<array{Doigt,Empreinte}> $pairs 
     */
    public function __construct(array $pairs = [])
    {
        $this->doigts = Map::of(...$pairs);
    }

    public function enregistrerEmpreinte(
        Doigt $doigt,
        Empreinte $empreinte,
    ): void {
        $this->doigts = $this->doigts->put($doigt, $empreinte);
    }

    /**
     * Retourne `true` si une empreinte existe pour chaque doigts
     */
    public function estComplete(): bool
    {
        return $this->doigts->keys()->equals(
            Doigt::toSet()
        );
    }
}
