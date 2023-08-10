# Test technique PHP

Cet exercice consiste en un modèle qui permet à un utilisateur de faire des demandes administratives pour obtenir une carte nationale d'identité ou un passeport.

L'implémentation actuelle est partielle et vous devez la compléter afin de respecter les règles suivantes :
- Un utilisateur doit pouvoir enregistrer ses empreintes
    - modélisez cette donnée
- Pour faire une demande il faut toutes les empreintes de l'utilisateur
    - rajoutez cette information dans les arguments de l'API de demande administrative
- Un utilisateur ne peut pas faire une demande s'il a déjà une pièce d'identité

La commande `make test` doit passer.

## Installation du projet

```sh
make install
```
