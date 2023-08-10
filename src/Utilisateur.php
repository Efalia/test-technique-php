<?php
declare(strict_types = 1);

namespace App;

final class Utilisateur
{
    /** @var non-empty-string */
    private string $nomComplet;
    private ?Adresse $adresse;
    private null|CarteNationaleIdentite|Passeport $pièceIdentité;

    /**
     * @param non-empty-string $nomComplet
     */
    public function __construct(string $nomComplet)
    {
        $this->nomComplet = $nomComplet;
        $this->adresse = null;
        $this->pièceIdentité = null;
    }

    public function ajouterAdresse(): void
    {
        $this->adresse = new Adresse('peu importe');
    }

    public function enregistrerEmpreintesDigitales(): void
    {
        // TODO
    }

    public function aCarteNationaleIdentité(): bool
    {
        return $this->pièceIdentité instanceof CarteNationaleIdentite;
    }

    public function aPasseport(): bool
    {
        return $this->pièceIdentité instanceof Passeport;
    }

    public function idPièceIdentité(): ?string
    {
        return $this->pièceIdentité?->toString();
    }
}
