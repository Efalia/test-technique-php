<?php

declare(strict_types=1);

namespace App;

use Innmind\Immutable\Map;

final class UtilisateurService
{
    /** @var Map<string,Utilisateur> $utilisateurs */
    private Map $utilisateurMap;

    public function __construct()
    {
        $this->utilisateurMap = Map::of();
    }

    public function put(UtilisateurId $utilisateurId, Utilisateur $utilisateur): void
    {
        $this->utilisateurMap = $this->utilisateurMap->put($utilisateurId->toMapKey(), $utilisateur);
    }

    public function get(UtilisateurId $utilisateurId): Utilisateur
    {
        return $this->utilisateurMap->get($utilisateurId->toMapKey())->match(
            fn (Utilisateur $utilisateur) => $utilisateur,
            fn () => throw new \Exception("Not found"),
        );
    }
}
