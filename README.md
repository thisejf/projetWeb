>Projet en cours - phase 2
  

# Projet web dynamique
## informations pratiques:
1. Le cours consistera en l’implémentation des différentes fonctionnalités définies lors des séances introductives (Analyse fonctionnelle).
2. L’utilisation du Framework Symfony 4 est obligatoire pour cette implémentation (le passage à Symfony 5 se fera peut-être en cours de projet) .
3. Certains aspects du cours de POO et Frameworks de 2ème année seront approfondis; certaines parties (formulaires; sécurité; i18n; query builders; services, event-listeners, outils front-end, upload de fichiers, utilisations d’APIs, tests...) seront abordées.
## étapes des évaluations:
- Implémentation du schema de la base de données avec Doctrine + les fixtures.
- Découpe du template avec twig.
- Utilisation et configuration de Encore/webpack.
- Organisation des controllers.
- Implémentation des concepts avancés vus au cours (services, requêtes DQL avancées).
- Implémentation de la gestion des utilisateurs.
- Upload de fichiers.
- Capacité à utiliser le framework dans ses aspects avancés.
## Cas d'Utilisation:
### Use Case pris en compte pour la Phase 1:
#### Afficher la page du site Bien-Être
Il s'agit de l'affichage de la page principal du site lorsqu'un utilisateur utilise un lien qui méne au site
Bien-Être.
#### Consulter la description d'un service
L'internaute peut à tout moment consulter la description et la photo associée à une catégorie de services.
En plus de la description du service, une liste de prestataires correspondant à la catégorie de services présentée et récemment inscrit sur le site est présentée à l'utilisateur.
#### Rechercher des prestataires
La recherche de prestataires s'effectue en combinant plusieurs critères :
- Une catégorie (voire plusieurs si cela est possible).
- Un critère de localisation qui peut s'exprimer soit via une localité, un code postal ou une
commune. Voire une combinaison de ces 3 critères.
- Le nom ou une partie du nom d'un prestataire.   

Ces critères s'additionnent de sorte à permettre une recherche précise.
Les prestataires trouvés sont triés alphabétiquement et sont paginés. L'utilisateur doit avoir la possibilité de passer de page en page, d'aller à la première ou à la dernière page ou de spécifier un n° de page.
Si aucun critère n'est rentré, le résultat sera l'entièreté des prestataires inscrits dans l'annuaire.
#### Consulter la fiche signalétique d'un prestataire
L'utilisateur peut consulter la fiche signalétique d'un prestataire.
On trouvera dans cette fiche outre les informations de base (nom, contact, logo, ...), la liste des photos présentant le prestataire, les promotions que le prestataire a déjà publiées et les stages qu'il propose. Attention, pour ces 2 listes, il faut tenir compte de la période de publication pour ne présenter que les stages ou promotions adéquats.
#### Consulter les catégories de services d'un prestataire
L'utilisateur peut consulter la liste des catégories de services choisies par le prestataire pour le représenter.
### Use Case pris en compte pour la Phase 2:
#### S'inscrire
Un utilisateur (internaute ou prestataire) a la possibilité de s'inscrire sur le site.
L'inscription soit en tant qu'internaute soit en tant que prestataire provoquera l'envoi d'un email au demandeur avec un lien (URL) vers un écran de confirmation de l'inscription.
#### Confirmer l'inscription
L'utilisateur (soit un prestataire soit un internaute) confirme l'inscription via l'utilisation d'une URL
présente dans l'email reçu.
#### S'authentifier
L'utilisateur s'authentifie sur le site en encodant son email et le mot de passe qu'il a choisi.
#### Gérer fiche Prestataire
L'internaute a la possibilité de mettre à jour les informations qui lui sont propres (nom, adresse, e-mail du contact, n° de TVA et le Logo).
Il peut aussi ajouter des photos représentatives de sa société.
#### Tenir à jour sa liste de catégories de services
Le prestataire peut choisir de spécifier une ou plusieurs catégories de services qui lui correspondent.
S'il ne trouve pas de catégorie le représentant, il a la possibilité d'en créer une nouvelle. Cette dernière
sera ou non ultérieurement validée par les administrateurs du site Annuaire Bien-Être.
#### Gérer fiche Internaute
L'internaute a la possibilité de mettre à jour les informations qui lui sont propres (nom, prénom, adresse et avatar).
### Use Case pris en compte pour la Phase 3
#### Ajouter un stage
Un prestataire a la possibilité de gérer les stages qu'il propose.
Il peut en ajouter un, en supprimer un ou en modifier un.
#### Ajouter une promotion
Un prestataire à la possibilité de gérer ses promotions
Il peut en ajouter une, en supprimer une ou en modifier une. Attention, à une promotion ...
- peut être associé une catégorie de services.
- doit être associé un PDF généré à partir d'un formulaire standard.
#### Gestion des catégories de services
Si une nouvelle catégorie de services est créée par un prestataire, il doit avoir la possibilité de ...
- La renommer ;
- La supprimer après avoir transférer les prestataires qui y étaient liés vers une autre catégorie. Dans
ce cas, on pourrait envisager l'envoi d'un mail automatique à ces prestataires pour leur signaler le
changement.
#### Gestion des images
L'administrateur a la possibilité de sélectionner les images qui défileront sur le bandeau du site ainsi
que l'ordre dans lequel elles apparaîtront.
#### Gestion du service du mois
L'administrateur décide de mettre en avant un service tous les mois.
Ce service sera affiché de manière particulière sur la page d'accueil.
Attention, il ne peut y avoir qu'un seul service mis en avant à la fois ; cela signifie que lorsqu'on en choisit un, le précédent est automatiquement retiré.
