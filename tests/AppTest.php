<?php

declare(strict_types=1);

namespace Tests;

use App\{
    CarteNationaleIdentite,
    Utilisateur,
    DemandeAdministrative,
    Doigt,
    Empreinte,
    EmpreintesDigitales,
    MotDePasse,
    Passeport,
    ServiceAdministratif,
    TypePièceIdentité,
    UtilisateurId,
    UtilisateurService,
};
use App\Exceptions\{
    AdresseManquante,
    EmpreinteDigitaleManquante,
    PieceIdentiteExistante
};
use App\DemandeAdministrative\API;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class AppTest extends TestCase
{
    public function teste l impossibilité pour un utilisateur sans adresse d obtenir une carte nationale d identité()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();
        $demandeAdministrative = DemandeAdministrative::actif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerCarteNationalIdentitéClosure = fn (API $api): CarteNationaleIdentite => $api->créerCarteNationaleIdentité(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        $this->expectException(AdresseManquante::class);
        $demandeAdministrative($créerCarteNationalIdentitéClosure);
    }

    public function teste l impossibilité pour un utilisateur sans adresse d obtenir un passeport()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();
        $demandeAdministrative = DemandeAdministrative::actif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );
        $créerPasseportClosure = fn (API $api): Passeport => $api->créerPasseport(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        $this->expectException(AdresseManquante::class);
        $demandeAdministrative($créerPasseportClosure);
    }

    public function teste l impossibilité pour un utilisateur d obtenir une carte nationale d identité si le service est inactif()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();
        $demandeAdministrative = DemandeAdministrative::inactif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerCarteNationalIdentitéClosure = fn (API $api): CarteNationaleIdentite => $api->créerCarteNationaleIdentité(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        $demandeAdministrative($créerCarteNationalIdentitéClosure);

        $this->assertFalse($utilisateur->aCarteNationaleIdentité());
    }

    public function teste l impossibilité pour un utilisateur d obtenir un passeport si le service est inactif()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();
        $demandeAdministrative = DemandeAdministrative::inactif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerPasseportClosure = fn (API $api): Passeport => $api->créerPasseport(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        $demandeAdministrative($créerPasseportClosure);

        $this->assertFalse($utilisateur->aCarteNationaleIdentité());
    }

    public function teste la possibilité pour un utilisateur d obtenir une carte nationale d identité()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();

        $demandeAdministrative = DemandeAdministrative::actif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerCarteNationalIdentitéClosure = fn (API $api): CarteNationaleIdentite => $api->créerCarteNationaleIdentité(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        $demandeAdministrative($créerCarteNationalIdentitéClosure);

        $this->assertTrue($utilisateur->aCarteNationaleIdentité());
    }

    public function teste la possibilité pour un utilisateur d obtenir un passeport()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();

        $demandeAdministrative = DemandeAdministrative::actif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerPasseportClosure = fn (API $api): Passeport => $api->créerPasseport(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        $demandeAdministrative($créerPasseportClosure);

        $this->assertTrue($utilisateur->aPasseport());
    }

    public function teste l impossibilité pour un utilisateur d obtenir une deuxième carte nationale d identité()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();

        $demandeAdministrative = DemandeAdministrative::actif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerCarteNationalIdentitéClosure = fn (API $api): CarteNationaleIdentite => $api->créerCarteNationaleIdentité(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        // première demande OK
        $demandeAdministrative($créerCarteNationalIdentitéClosure);
        $this->assertTrue($utilisateur->aCarteNationaleIdentité());

        // seconde demande KO
        $this->expectException(PieceIdentiteExistante::class);
        $demandeAdministrative($créerCarteNationalIdentitéClosure);
    }

    public function teste l impossibilité pour un utilisateur d obtenir un deuxième passeport()
    {
        $utilisateur = new Utilisateur('Toto');
        $utilisateur->ajouterAdresse();
        $utilisateur->enregistrerEmpreintesDigitales(
            $this->empreintesDigitalesValide()
        );

        $utilisateurService = new UtilisateurService();

        $demandeAdministrative = DemandeAdministrative::actif($utilisateurService);
        $motDePasse = new MotDePasse;

        $utilisateurId = new UtilisateurId(
            nomComplet: $utilisateur->nomComplet(),
            motDePasse: $motDePasse,
        );

        $utilisateurService->put(
            $utilisateurId,
            $utilisateur
        );

        $créerPasseportClosure = fn (API $api): Passeport => $api->créerPasseport(
            $motDePasse,
            $utilisateur->nomComplet(),
            $utilisateur->adresse(),
            $utilisateur->empreintesDigitales(),
        );

        // 1ère demande OK
        $demandeAdministrative($créerPasseportClosure);
        $this->assertTrue($utilisateur->aPasseport());

        // 2nd demande KO
        $this->expectException(PieceIdentiteExistante::class);
        $demandeAdministrative($créerPasseportClosure);
    }

    public function testEmpreintesDigitalesIncomplete()
    {
        $empreintesDigitales = new EmpreintesDigitales();
        $empreintesDigitales->enregistrerEmpreinte(
            Doigt::Pouce,
            new Empreinte,
        );
        $empreintesDigitales->enregistrerEmpreinte(
            Doigt::Index,
            new Empreinte,
        );
        $this->assertFalse($empreintesDigitales->estComplete());
    }

    public function testEmpreintesDigitalesComplete()
    {
        $empreintesDigitales = $this->empreintesDigitalesValide();

        $this->assertTrue($empreintesDigitales->estComplete());
    }

    private function empreintesDigitalesValide(): EmpreintesDigitales
    {
        return new EmpreintesDigitales(
            [
                [Doigt::Pouce, new Empreinte],
                [Doigt::Majeur, new Empreinte],
                [Doigt::Annulaire, new Empreinte],
                [Doigt::Auriculaire, new Empreinte],
                [Doigt::Index, new Empreinte],
            ]
        );
    }

    public function testUtilsateurService(): void
    {
        $nomComplet = "Hello";
        $motDePasse = new MotDePasse;

        $userId = new UtilisateurId(
            $motDePasse,
            $nomComplet,
        );

        $sameId = new UtilisateurId(
            $motDePasse,
            $nomComplet,
        );

        $user = new Utilisateur($nomComplet);

        $this->assertEquals($userId, $sameId);
        $this->assertNotSame($userId, $sameId);

        $utilisateurService = new UtilisateurService();
        $utilisateurService->put(
            $userId,
            $user
        );

        $this->assertEquals($user, $utilisateurService->get($userId));
        $this->assertEquals($user, $utilisateurService->get($sameId));
    }

    public function teste l impossibilité d enregistrer une pièce d identité sans validation()
    {
        $utilisateur = new Utilisateur('hello');

        $this->expectException(AdresseManquante::class);

        $utilisateur->enregistrerPièceIdentité(
            new CarteNationaleIdentite(
                Uuid::uuid4()
            )
        );
    }

}
