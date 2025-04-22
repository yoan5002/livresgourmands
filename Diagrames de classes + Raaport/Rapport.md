#  LivresGourmands.net

**Plateforme de gestion de livres de cuisine**, développée avec Laravel 12, Bootstrap 5, et MySQL.  
Elle permet à différents rôles (admin, éditeur, gestionnaire) de gérer des livres, commentaires, ventes, et utilisateurs.

---

## 🔧 Technologies

- Laravel 12 (PHP 8.3)
- MySQL
- Bootstrap 5
- Laravel Breeze (authentification)
- Vite
- PlantUML (diagrammes)

---

##  Fonctionnalités principales

###  Administrateur
- Création et suppression d’utilisateurs avec assignation de rôles
- Gestion sécurisée via interface dédiée

###  Éditeur
- Ajout et suppression de livres avec image
- Ajout de catégories
- Soumission de commentaires sur des livres
- Visualisation de ses livres et commentaires

### Gestionnaire
- Visualisation des ventes avec détails
- Mise à jour du stock de chaque livre

---


##  Mot de passe


Rôle | Email par défaut | Mot de passe
Administrateur | yoanlable@gmail.com | password
Éditeur | serena@gmail.com | serena12345
Gestionnaire | selena@gmail.com.com | selena1234


---

##  Installation

```bash
git clone https://github.com/yoan5002/livresgourmands.git
cd livresgourmands
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link




















