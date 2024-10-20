```markdown
### Wiki du Projet Symfony Back - Movie App

---

## Table des matières

1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Fonctionnalités](#fonctionnalités)
5. [API Endpoints](#api-endpoints)
6. [Contribuer](#contribuer)

---

### Introduction

Bienvenue dans le projet **Symfony Back** pour l'application **movie_app**. Ce projet fournit une API pour gérer les films, les acteurs et les catégories, ainsi qu'un système d'authentification complet.

### Installation

Pour installer le projet, suivez ces étapes :

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/wr506d.git
   cd wr506d/application
   ```

2. Installez les dépendances :
   ```bash
   composer install
   ```

3. Configurez votre base de données dans le fichier `.env` :
   ```
   DATABASE_URL="mysql://symfony:PASSWORD@symfony-db:3306/symfony?serverVersion=10.8.8-MariaDB&charset=utf8mb4"
   ```

4. Exécutez les migrations :
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

### Configuration

Assurez-vous que votre serveur web (Apache, Nginx) est configuré pour pointer vers le répertoire `public/`. 

### Fonctionnalités

- **Gestion des utilisateurs :**
  - Inscription
  - Connexion
  - Modification du mot de passe

- **Gestion des films :**
  - CRUD (Création, Lecture, Mise à jour, Suppression) des films
  - Association avec des acteurs et des catégories

- **Gestion des acteurs :**
  - CRUD des acteurs

- **Gestion des catégories :**
  - CRUD des catégories

### API Endpoints

Voici quelques endpoints disponibles :

- **Authentification :**
  - `POST /api/login` - Connexion
  - `POST /api/users` - Inscription
  - `PUT /api/users` - Modifier le mot de passe

- **Films :**
  - `GET /api/movies` - Liste des films
  - `POST /api/movies` - Créer un nouveau film
  - `GET /api/movies/{id}` - Détails d'un film
  - `PUT /api/movies/{id}` - Mettre à jour un film
  - `DELETE /api/movies/{id}` - Supprimer un film

- **Acteurs :**
  - `GET /api/actors` - Liste des acteurs
  - `POST /api/actors` - Créer un nouvel acteur

- **Catégories :**
  - `GET /api/categories` - Liste des catégories
  - `POST /api/categories` - Créer une nouvelle catégorie

### Contribuer

Les contributions sont les bienvenues ! Veuillez suivre ces étapes :

1. Forkez le projet.
2. Créez votre branche (`git checkout -b feature/vich`). (dernière branche à jour avant le développement)
3. Commitez vos modifications (`git commit -m 'Ajoutez vos features'`).
4. Poussez votre branche (`git push origin feature/vich`).
5. Ouvrez une Pull Request.
```
