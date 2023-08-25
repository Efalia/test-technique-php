<?php

declare(strict_types=1);

namespace App;

use App\DemandeAdministrative\API;

final class DemandeAdministrative
{

    private function __construct(
        private bool $featureFlag,
        private UtilisateurService $utilisateurService,
    ) {
    }

    public static function actif(UtilisateurService $utilisateurService): self
    {
        return new self(true, $utilisateurService);
    }

    public static function inactif(UtilisateurService $utilisateurService): self
    {
        return new self(false, $utilisateurService);
    }

    /**
     * @template T
     *
     * @param callable(API): T $action
     *
     * @return ?T
     */
    public function __invoke(callable $action)
    {
        return match ($this->featureFlag) {
            true => $action(
                new API(
                    $this->utilisateurService
                )
            ),
            false => null,
        };
    }
}
