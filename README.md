# Test technique PHP

## Objectif

Permettre à un utilisateur de faire une demande administrative pour obtenir une carte nationale d'identité ou un passeport.

## Implémentation

Complétez le code existant afin de pouvoir respecter les règles suivantes :
- Un utilisateur doit pouvoir enregistrer ses empreintes (modèle à créer).
- Toutes les empreintes d'un utilisateur sont nécessaires pour faire une demande (ajouter cette information dans les arguments de l'API de demande administrative).
- Il est impossible de faire une demande si l'utilisateur dispose déjà d'une pièce d'identité.

## Attendu

Faire passer au minimum tous les tests existants.

## Installation

```sh
make install
```

## Lancement des tests

```sh
make test
```
