<?php
declare(strict_types = 1);

namespace App\DemandeAdministrative;

use App\{
    Adresse,
    CarteNationaleIdentite,
    Passeport,
    MotDePasse,
};
use Ramsey\Uuid\Uuid;

final class API
{
    /**
     * @param non-empty-string $nomComplet
     */
    public function créerCarteNationaleIdentité(
        MotDePasse $motDePasse,
        string $nomComplet,
        Adresse $adresse,
    ): CarteNationaleIdentite {
        return new CarteNationaleIdentite(Uuid::uuid4());
    }

    /**
     * @param non-empty-string $nomComplet
     */
    public function créerPasseport(
        MotDePasse $motDePasse,
        string $nomComplet,
        Adresse $adresse,
    ): Passeport {
        return new Passeport(Uuid::uuid4());
    }
}
