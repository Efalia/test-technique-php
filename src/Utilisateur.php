<?php

declare(strict_types=1);

namespace App;

final class Utilisateur
{
    /** @var non-empty-string */
    private string $nomComplet;
    private ?Adresse $adresse;
    private ?PièceIdentité $pièceIdentité;
    private ?EmpreintesDigitales $empreintesDigitales;

    /**
     * @param non-empty-string $nomComplet
     */
    public function __construct(
        string $nomComplet,
    ) {
        $this->nomComplet = $nomComplet;
        $this->adresse = null;
        $this->pièceIdentité = null;
        $this->empreintesDigitales = null;
    }

    public function ajouterAdresse(): void
    {
        $this->adresse = new Adresse('peu importe');
    }

    public function enregistrerEmpreintesDigitales(?EmpreintesDigitales $empreintesDigitales = null): void
    {
        $this->empreintesDigitales = $empreintesDigitales ?? new EmpreintesDigitales();
    }

    public function enregistrerPièceIdentité(PièceIdentité $pièceIdentité): void
    {
        $this->pièceIdentité = $pièceIdentité;
    }

    public function aCarteNationaleIdentité(): bool
    {
        return $this->pièceIdentité instanceof CarteNationaleIdentite;
    }

    public function aPasseport(): bool
    {
        return $this->pièceIdentité instanceof Passeport;
    }

    public function aPièceIdentité(): bool
    {
        return false === \is_null($this->pièceIdentité);
    }

    public function idPièceIdentité(): ?string
    {
        return $this->pièceIdentité?->toString();
    }

    /**
     * @return non-empty-string
     */
    public function nomComplet(): string
    {
        return $this->nomComplet;
    }

    public function adresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function empreintesDigitales(): ?EmpreintesDigitales
    {
        return $this->empreintesDigitales;
    }
}
