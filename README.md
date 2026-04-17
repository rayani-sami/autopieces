# AutoPieces — Guide d'installation complet

## Prérequis système
- PHP >= 8.1 avec extensions: BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, PDO_MySQL, Tokenizer, XML
- MySQL >= 8.0 (ou MariaDB >= 10.4)
- Composer >= 2.x
- Node.js >= 16 (optionnel, pour recompiler les assets)

---

## Installation étape par étape

### 1. Extraire le projet
```bash
unzip autopart.zip
cd autopart_full
```

### 2. Installer les dépendances PHP
```bash
composer install --no-dev --optimize-autoloader
```

### 3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

Éditez le fichier `.env` et configurez :
```env
APP_URL=http://votre-domaine.tn
DB_DATABASE=autopart_db
DB_USERNAME=votre_user
DB_PASSWORD=votre_password
MAIL_MAILER=smtp
MAIL_HOST=smtp.votre-provider.tn
MAIL_FROM_ADDRESS=noreply@votre-domaine.tn
```

### 4. Créer la base de données MySQL
```sql
CREATE DATABASE autopart_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Exécuter les migrations et le seeder
```bash
php artisan migrate --seed
```
Cette commande crée toutes les tables et insère des données de démonstration.

### 6. Lien symbolique pour les images
```bash
php artisan storage:link
```

### 7. Optimiser pour la production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 8. Lancer le serveur de développement
```bash
php artisan serve
```

---

## Accès à l'application

| URL | Description |
|-----|-------------|
| http://localhost:8000 | Site frontend |
| http://localhost:8000/admin | Panel d'administration |
| http://localhost:8000/connexion | Page de connexion |

**Compte admin par défaut :**
- Email: `admin@autopart.tn`
- Mot de passe: `password`
> ⚠️ Changez le mot de passe après la première connexion !

---

## Structure du projet

```
autopart_full/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Frontend/     # Contrôleurs site public
│   │   │   ├── Admin/        # Contrôleurs admin
│   │   │   └── Auth/         # Authentification
│   │   ├── Middleware/       # Middleware custom
│   │   └── Kernel.php
│   ├── Models/               # 15 modèles Eloquent
│   ├── Services/             # CartService, OrderService, VehicleService
│   └── Providers/
├── config/                   # Fichiers de configuration
├── database/
│   ├── migrations/           # 11 migrations
│   └── seeders/              # Données de démo
├── lang/fr/                  # Traductions françaises
├── public/
│   ├── css/app.css           # Styles
│   ├── js/app.js             # JavaScript
│   ├── templates/            # CSV d'import
│   └── index.php
├── resources/views/
│   ├── layouts/              # Layouts app + admin
│   ├── components/           # Composants réutilisables
│   ├── frontend/             # Vues site public
│   │   ├── home/             # Page d'accueil
│   │   ├── catalog/          # Catalogue, produit, recherche
│   │   ├── vehicle/          # Navigation véhicule
│   │   ├── cart/             # Panier
│   │   ├── checkout/         # Commande
│   │   ├── account/          # Espace client
│   │   └── auth/             # Auth (connexion, inscription...)
│   ├── admin/                # Vues admin
│   │   ├── dashboard/        # Dashboard stats
│   │   ├── products/         # Gestion produits
│   │   ├── categories/       # Gestion catégories
│   │   ├── orders/           # Commandes + factures PDF
│   │   ├── vehicles/         # Marques/modèles/motorisations
│   │   ├── users/            # Gestion utilisateurs
│   │   └── settings/         # Paramètres, coupons, bannières
│   └── emails/               # Templates emails
└── routes/
    └── web.php               # Toutes les routes
```

---

## Fonctionnalités complètes

### Frontend (Site public)
- ✅ Page d'accueil : bannières slider, catégories, produits vedettes, marques
- ✅ **Sélection véhicule** : Constructeur → Modèle → Motorisation (3 niveaux)
- ✅ **Recherche par immatriculation tunisienne** (TU/RS)
- ✅ Catalogue pièces avec filtres (marque, prix, tri)
- ✅ Fiche produit : galerie images, véhicules compatibles, produits similaires
- ✅ Panier persistant (DB + session, fusion à la connexion)
- ✅ Codes promo / coupons (% ou montant fixe)
- ✅ Checkout avec livraison calculée dynamiquement
- ✅ Suivi commande en temps réel
- ✅ Espace client : commandes, adresses, véhicules sauvegardés, profil
- ✅ Authentification complète (connexion, inscription, reset password)
- ✅ Pages statiques : CGV, confidentialité, contact, support
- ✅ Bouton WhatsApp intégré
- ✅ Design responsive Bootstrap 5

### Back-office Admin
- ✅ Dashboard avec statistiques (CA, commandes, stock faible...)
- ✅ CRUD produits complet (images, compatibilités véhicules)
- ✅ Gestion catégories hiérarchiques
- ✅ Gestion commandes avec workflow de statut
- ✅ Génération factures PDF (DomPDF)
- ✅ Gestion véhicules (marques / modèles / motorisations + import CSV)
- ✅ Gestion utilisateurs avec rôles (admin / manager / client)
- ✅ Gestion coupons de réduction
- ✅ Paramètres site, frais de livraison, bannières

---

## Logique de livraison
- **Gratuite** dès 200 TND de commande
- **Grand Tunis** (Tunis, Ariana, Ben Arous, Manouba...) : 8 TND
- **Autres gouvernorats** : 12 TND

---

## Import de véhicules par CSV
Un template est disponible dans `public/templates/import_vehicules.csv`

Colonnes requises : `make, model, engine, fuel_type, displacement, power_hp, engine_code, year_from, year_to`

---

## Configuration email
Pour activer l'envoi d'emails de confirmation de commande, configurez dans `.env` :
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre@email.com
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@autopart.tn
MAIL_FROM_NAME="AutoPart"
```

---

## Technologies utilisées
| Technologie | Version | Usage |
|-------------|---------|-------|
| Laravel | 10.x | Framework PHP |
| MySQL | 8.0+ | Base de données |
| Bootstrap | 5.3 | Interface utilisateur |
| Spatie Permission | 6.x | Gestion rôles/permissions |
| DomPDF | 2.x | Génération factures PDF |
| Font Awesome | 6.5 | Icônes |
| Livewire | 3.x (optionnel) | Composants réactifs |
