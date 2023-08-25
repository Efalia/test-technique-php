<?php

declare(strict_types=1);

namespace App\DemandeAdministrative;

use App\{
    Adresse,
    CarteNationaleIdentite,
    EmpreintesDigitales,
    Passeport,
    MotDePasse,
    Utilisateur,
    UtilisateurId,
    UtilisateurService,
};
use App\DemandeAdministrative\Exceptions\AdresseManquante;
use App\DemandeAdministrative\Exceptions\EmpreinteDigitaleManquante;
use App\DemandeAdministrative\Exceptions\PieceIdentiteExistante;
use Ramsey\Uuid\Uuid;

final class API
{
    public function __construct(
        private UtilisateurService $utilisateurService
    ) {
    }

    /**
     * @param non-empty-string $nomComplet
     */
    public function créerCarteNationaleIdentité(
        MotDePasse $motDePasse,
        string $nomComplet,
        ?Adresse $adresse,
        ?EmpreintesDigitales $empreintesDigitales,
    ): CarteNationaleIdentite {
        $utilisateurId = new UtilisateurId(
            $motDePasse,
            $nomComplet,
        );
        $utilisateur = $this->utilisateurService->get($utilisateurId);

        if ($adresse) {
            $utilisateur->ajouterAdresse();
        }

        if ($empreintesDigitales) {
            $utilisateur->enregistrerEmpreintesDigitales($empreintesDigitales);
        }

        $pièceIdentité = new CarteNationaleIdentite(Uuid::uuid4());

        $utilisateur->enregistrerPièceIdentité($pièceIdentité);

        return $pièceIdentité;
    }

    /**
     * @param non-empty-string $nomComplet
     */
    public function créerPasseport(
        MotDePasse $motDePasse,
        string $nomComplet,
        ?Adresse $adresse,
        ?EmpreintesDigitales $empreintesDigitales,
    ): Passeport {
        $utilisateurId = new UtilisateurId(
            $motDePasse,
            $nomComplet,
        );
        $utilisateur = $this->utilisateurService->get($utilisateurId);

        if ($adresse) {
            $utilisateur->ajouterAdresse();
        }

        if ($empreintesDigitales) {
            $utilisateur->enregistrerEmpreintesDigitales($empreintesDigitales);
        }

        $pièceIdentité = new Passeport(Uuid::uuid4());

        $utilisateur->enregistrerPièceIdentité($pièceIdentité);

        return $pièceIdentité;
    }
}
