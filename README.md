# 🏛️ CiviloNet — Plateforme de demande d'actes d'état civil en ligne (Laravel)

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3-FDAE4B?style=flat)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=flat&logo=tailwindcss&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=flat&logo=alpinedotjs&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![CinetPay](https://img.shields.io/badge/Paiement-CinetPay%20(test)-green?style=flat)

> Application web qui permet à un citoyen de **demander en ligne un acte de naissance, de mariage ou de décès**, de **payer par mobile money** et de **télécharger son document**, pendant que l'administration traite les demandes depuis un **back-office**.
> **Projet académique réalisé en équipe** — Licence Informatique & Sciences du Numérique (UVCI), 2025.

> ⚠️ **Prototype pédagogique, non officiel.** CiviloNet n'a aucun lien avec l'administration ivoirienne. Les documents générés par l'application sont fictifs et n'ont **aucune valeur légale**.

---

## 🎯 Problématique

Obtenir un extrait d'acte d'état civil impose souvent plusieurs déplacements à la mairie, de l'attente et un suivi difficile. CiviloNet propose un parcours entièrement en ligne : **demande → paiement → traitement → téléchargement**, avec un suivi en temps réel pour le citoyen.

## ✨ Fonctionnalités

### Espace citoyen

- Inscription, connexion, vérification d'e-mail et réinitialisation du mot de passe (Laravel Breeze)
- Formulaires dédiés pour chaque type d'acte : **naissance**, **mariage**, **décès**
- **Paiement mobile money** via l'API CinetPay (mode test), avec retour et notification de paiement (webhook)
- **Tableau de bord** : suivi de chaque demande par statut, détail, annulation
- **Notifications** à chaque changement de statut
- **Téléchargement du document en PDF**, avec numéro d'acte et **QR code**

### Back-office administrateur (Filament)

- Gestion des demandes : validation, rejet avec motif, date de traitement
- Gestion des actes de naissance, de mariage et de décès, et des utilisateurs
- **Tableau de bord statistique** : fréquentation du site (vues par page, évolution mensuelle)

### Cycle de vie d'une demande

```
En attente de paiement ──▶ Payée / en cours ──▶ En traitement ──▶ Traitée (PDF disponible)
          │                                              │
          └──────────────▶ Annulée                       └──▶ Rejetée (avec motif)
```

## 🛠️ Stack technique

| Couche | Technologies |
|---|---|
| Backend | Laravel 12, PHP 8.2+ |
| Back-office | Filament 3 (ressources, formulaires, widgets) |
| Frontend | Blade, Tailwind CSS, Alpine.js, Vite |
| Base de données | MySQL (migrations Laravel) |
| Paiement | SDK CinetPay (mobile money), webhook de notification |
| Documents | DomPDF, Simple QR Code |
| Authentification | Laravel Breeze |

## 🧩 Architecture

```
app/
├── Http/Controllers/     # Citoyen, demandes, validation, paiement CinetPay, téléchargement
├── Services/             # CinetPayService (paiement) · PdfGeneratorService (PDF + QR code)
├── Models/               # Demande, ActeNaissance, ActeMariage, ActeDeces, Notification, PageView
└── Filament/             # Back-office : ressources et widgets statistiques
resources/views/
├── citoyen/              # Tableau de bord et suivi des demandes
├── demandes/             # Formulaires par type d'acte
└── pdf/                  # Gabarits PDF des actes (fictifs)
database/migrations/      # Schéma : demandes, actes, paiement, notifications, statistiques
```

## ▶️ Installation

**Prérequis** : PHP 8.2+, Composer, Node.js, MySQL (par exemple via WampServer).

```bash
git clone https://github.com/itraore05/civilonet_civi.git
cd civilonet_civi
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Dans `.env` :

- configurer MySQL (`DB_CONNECTION=mysql`, `DB_DATABASE=civilonet`…) après avoir créé la base ;
- pour tester le paiement, renseigner les identifiants de **votre** compte de test CinetPay (`CINETPAY_TEST_MODE`, `CINETPAY_TEST_SITE_ID`, `CINETPAY_TEST_API_KEY`).

```bash
php artisan migrate
php artisan serve      # application : http://127.0.0.1:8000
npm run dev            # compilation des assets
```

Back-office : `http://127.0.0.1:8000/admin`

Le fichier [`Guide d'execution du Projet.txt`](Guide%20d'execution%20du%20Projet.txt) détaille l'installation pas à pas sous Windows.

## 🙋 Mon rôle

- **Chef de projet** : organisation de l'équipe, répartition des tâches, suivi de l'avancement et coordination jusqu'à la livraison.
- **Développement frontend** : interfaces Blade, Tailwind CSS et Alpine.js (pages publiques, espace citoyen, formulaires de demande, tableau de bord de suivi).

## 💡 Compétences mobilisées

- Développement d'une application **Laravel** complète (MVC, Eloquent, migrations, middlewares)
- **Intégration d'une API de paiement** et gestion d'un webhook
- Génération de **documents PDF** dynamiques avec QR code
- Création d'un **back-office** avec Filament
- Gestion d'un **workflow métier** à plusieurs statuts et notifications utilisateur
- **Gestion de projet** et coordination d'une équipe de développement

## 👤 Auteur

**Ismaël Traoré** — Développeur Data & IA · chef de projet et développeur frontend de CiviloNet
📧 contact.traoreimael@gmail.com · 💼 [LinkedIn](https://www.linkedin.com/in/ismael-traor%C3%A9-m-4007a2225/)
