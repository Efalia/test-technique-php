<?php
declare(strict_types = 1);

namespace Tests;

use App\{
    Utilisateur,
    DemandeAdministrative,
    MotDePasse,
};
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    public function teste l impossibilité pour un utilisateur sans adresse d obtenir une carte nationale d identité()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::actif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertFalse($utilisateur->aCarteNationaleIdentité());
    }

    public function teste l impossibilité pour un utilisateur sans adresse d obtenir un passeport()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::actif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertFalse($utilisateur->aPasseport());
    }

    public function teste l impossibilité pour un utilisateur d obtenir une carte nationale d identité si le service est inactif()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::inactif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertFalse($utilisateur->aCarteNationaleIdentité());
    }

    public function teste l impossibilité pour un utilisateur d obtenir un passeport si le service est inactif()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::inactif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertFalse($utilisateur->aPasseport());
    }

    public function teste la possibilité pour un utilisateur d obtenir une carte nationale d identité()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::actif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertTrue($utilisateur->aCarteNationaleIdentité());
    }

    public function teste la possibilité pour un utilisateur d obtenir un passeport()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::actif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertTrue($utilisateur->aPasseport());
    }

    public function teste l impossibilité pour un utilisateur d obtenir une deuxième carte nationale d identité()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::actif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertTrue($utilisateur->aCarteNationaleIdentité());
        $idPièce = $utilisateur->idPièceIdentité();
        $this->assertIsString($idPièce);

        // TODO appelez votre code ici

        $this->assertTrue($utilisateur->aCarteNationaleIdentité());
        $this->assertSame($idPièce, $utilisateur->idPièceIdentité());
    }

    public function teste l impossibilité pour un utilisateur d obtenir un deuxième passeport()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales();
        $demandeAdministrative = DemandeAdministrative::actif();
        $motDePasse = new MotDePasse;

        // TODO appelez votre code ici

        $this->assertTrue($utilisateur->aPasseport());
        $idPièce = $utilisateur->idPièceIdentité();
        $this->assertIsString($idPièce);

        // TODO appelez votre code ici

        $this->assertTrue($utilisateur->aPasseport());
        $this->assertSame($idPièce, $utilisateur->idPièceIdentité());
    }
}
