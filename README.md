# Vite & Gourmand 🍽️

Application web de gestion pour une entreprise de traiteur événementiel, développée en **PHP 8.3 orienté objet** selon une architecture **MVC sans framework**, dans le cadre de l'ECF du Titre Professionnel Développeur Web et Web Mobile.

L'application propose quatre espaces distincts : **public** (présentation de l'entreprise, consultation et filtrage des menus, avis clients), **client** (commande et suivi), **employé** (traitement des commandes, gestion du catalogue, suivi de la restitution de matériel prêté) et **administrateur** (gestion des employés, création de menus avec galerie photos, tableau de bord statistique).

## Fonctionnalités principales

- Page d'accueil présentant l'entreprise, l'équipe et les avis clients validés
- Catalogue de menus avec filtrage dynamique par thème et régime alimentaire (AJAX, sans rechargement)
- Détail de menu en popup dynamique avec galerie multi-photos
- Commande en ligne avec confirmation et notification par email (PHPMailer)
- Suivi de commande avec historique complet des statuts (`historique_statut`)
- Annulation de commande avec règles différenciées selon le rôle
- Gestion du prêt de matériel : statut intermédiaire, email automatique (délai de 10 jours ouvrés, frais de 600€ en cas de non-restitution), traçabilité de la restitution
- Authentification et contrôle d'accès à quatre niveaux (middleware)
- Interface adaptée à l'affichage mobile (responsive)
- Tableau de bord administrateur alimenté par MongoDB (statistiques)

## Stack technique

| Couche | Technologie |
|---|---|
| Back-end | PHP 8.3 (POO, MVC, routeur personnalisé) |
| Base de données relationnelle | MySQL (via PDO, requêtes préparées) |
| Base de données NoSQL | MongoDB (statistiques du dashboard) |
| Front-end | HTML5, CSS3 responsive, JavaScript vanilla (fetch API) |
| Emails | PHPMailer (SMTP) |
| Dépendances & autoload | Composer (PSR-4 : `App\` → `src/App/`) |
| Versioning | Git / GitHub (flux `main` / `develop`) |
| Environnement local | MAMP (Apache + MySQL + PHP sur macOS) |
| Déploiement | Railway (build Railpack, environnement FrankenPHP) |

## Comment j'ai travaillé sur ce projet

Je développe en local avec **MAMP**, qui installe en une fois Apache, MySQL et PHP sur macOS, avec phpMyAdmin pour gérer la base sans passer par la ligne de commande à chaque fois, et la possibilité de choisir précisément la version de PHP (8.3, la même qu'en production). Pour un projet PHP classique développé seul, c'est plus rapide à mettre en place qu'une solution conteneurisée type Docker, tout en restant proche d'un vrai environnement serveur. Apache tourne sur le port **8888**, MySQL sur le port **8889**.

J'écris le code dans **Visual Studio Code**, avec quelques extensions utiles au quotidien : PHP Intelephense pour l'autocomplétion, GitLens pour naviguer dans l'historique Git, et le terminal intégré pour ne jamais changer de fenêtre entre écrire, tester et commiter.

**Composer** structure le projet dès le départ : l'autoload PSR-4 (`App\` → `src/App/`) organise les classes par namespace et évite d'écrire des `require` à la main partout, ce qui devient vite indispensable avec autant de contrôleurs et de modèles répartis par espace (public, client, employé, admin).

**Git et GitHub** sont utilisés depuis le premier jour, avec des commits réguliers et un dépôt distant qui sert à la fois de sauvegarde et de canal de rendu du projet. Le fichier `.gitignore` exclut le dossier `vendor/` (réinstallable en une commande) et la configuration contenant les mots de passe.

**MongoDB** m'a demandé un peu plus de travail en local : le driver PHP (l'extension `mongodb`) n'est pas installé par défaut, j'ai dû le compiler moi-même avec les outils fournis par PHP 8.3 sur MAMP, en parallèle d'un serveur MongoDB Community qui tourne à côté de MySQL. Ce travail permet au tableau de bord statistique de fonctionner en local exactement comme en production.

### Le déploiement sur Railway

C'est la partie qui m'a pris le plus de temps à comprendre. Au départ, j'avais prévu de conteneuriser l'application avec **Docker** : une image basée sur `php:8.3-apache`, avec les extensions PDO MySQL et MongoDB installées manuellement. Mais Apache refusait de démarrer à cause d'un conflit entre deux modules internes (`mpm_prefork` et `mpm_event` chargés en même temps), et malgré plusieurs tentatives de correction, le problème persistait.

J'ai donc changé d'approche et laissé Railway gérer ça lui-même via **Railpack**, son système de build natif : il détecte automatiquement que le projet est en PHP et prépare un environnement **FrankenPHP** (un serveur d'application PHP moderne, basé sur Caddy) sans que j'aie besoin de maintenir une configuration Apache à la main. C'est un bon exemple de choix pragmatique : plutôt que de s'acharner sur une configuration bas niveau compliquée à déboguer, j'ai préféré une solution native déjà bien intégrée à la plateforme.

Un fichier `Caddyfile` à la racine du projet indique où se trouve la racine web (`public/`, là où est `index.php`) et active à la fois le traitement du PHP et le service des fichiers statiques (CSS, JS, images). Une commande de build personnalisée installe en plus l'extension `pdo_mysql`, nécessaire à la connexion MySQL et absente par défaut de l'environnement Railpack.

## Déploiement — en résumé

- **Plateforme** : Railway, build via Railpack, environnement FrankenPHP
- **Bases de données** : un service MySQL et un service MongoDB séparés, chacun avec ses propres identifiants, connectés à l'application via le réseau privé Railway
- **Serveur web** : configuré par le `Caddyfile` à la racine (racine web `public/`, PHP et fichiers statiques servis)
- **Variables d'environnement** : gérées depuis l'interface Railway (connexion base de données, MongoDB, SMTP, et `APP_URL` pour construire les liens envoyés par email)
- **Branches** : le déploiement se déclenche automatiquement à chaque push sur `main` ; le travail au jour le jour se fait sur `develop` et des branches de fonctionnalité qui en découlent

## Prérequis

- PHP **8.3** ou supérieur
- Composer 2.x
- MySQL 5.7+ (ou MariaDB)
- MongoDB Community Server + extension PHP `mongodb`
- MAMP (recommandé sur macOS) ou tout équivalent Apache/MySQL/PHP

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/ismailzemmoury20/vitegourmand.git
cd vitegourmand
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Créer la base de données

Créer une base `vitegourmand` (via phpMyAdmin fourni par MAMP), puis importer la structure et les données de test.

### 4. Configurer l'environnement

```bash
cp .env.example .env
```

```php
// .env — exemple pour MAMP
$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_PORT'] = '8889';
$_ENV['DB_NAME'] = 'vitegourmand';
$_ENV['DB_USER'] = 'root';
$_ENV['DB_PASSWORD'] = 'root';

$_ENV['MONGO_URI'] = 'mongodb://localhost:27017';

$_ENV['MAIL_HOST'] = 'smtp.exemple.com';
$_ENV['MAIL_USER'] = '';
$_ENV['MAIL_PASSWORD'] = '';
```

> ⚠️ `.env` est exclu du versioning via `.gitignore` : il ne doit **jamais** être commité. Seul `.env.example`, sans valeurs sensibles, est versionné.

### 5. Lancer l'application

Avec MAMP : définir la racine du serveur sur le dossier du projet, démarrer Apache et MySQL, puis ouvrir `http://localhost:8888`. Démarrer aussi MongoDB (`mongod`) pour le tableau de bord administrateur.

## Structure du projet

```
vitegourmand/
├── public/                  # Racine web : index.php, CSS, JS, images
├── src/
│   └── App/                 # Namespace App (autoload PSR-4)
│       ├── Controllers/     # Un jeu de contrôleurs par espace
│       ├── Models/           # Classes Table (requêtes PDO / MongoDB)
│       └── Middleware/       # AuthMiddleware (contrôle d'accès par rôle)
├── View/
│   ├── templates/           # Layouts : un gabarit de page par espace
│   └── partials/            # Fragments réutilisables (header, footer, sidebars, popups)
├── database/                # Structure et données de test
├── Caddyfile                # Configuration du serveur web en production
├── .env / .env.example
├── composer.json
└── README.md
```

## Sécurité

Le détail des mécanismes de sécurité (validation des formulaires, requêtes préparées, hachage bcrypt, contrôle d'accès par rôle, gestion des secrets) est documenté dans le dossier de projet.

## Auteur

**Ismail Zemmoury** — Titre Professionnel Développeur Web et Web Mobile (2026)