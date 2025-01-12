# SuptechOlympiad

## Description:

<p>SuptechOlympiad: est une application web crée en Laravel pour la gestion des activitées parascolaires de mon école Suptech Santé des activitées à savoir(ping pong, football, chess et basketball).</p>

## Fonctionnalitées

<ul>
    <li>Permet aux étudiants de participer facilement aux activitées </li>
    <li>Faciliter la planficiation et la gestion des matches pour les organisateurs</li>
</ul>

## Guide d'installation

1. cloner le repository:

```bash
    git clone https://github.com/HamzaEng/SuptechOlympiad.git
```

2. Naviger vers le projet:

```bash
    cd SuptechOlympiad
```

3. installer les dépendences:

```bash
    composer install
```

```bash
    npm install
```

4. migrate tables and seed data 

```bash
    php artisan migrate 
```
```bash
    php artisan db:seed --class=ActivitySeeder 
```

```bash
    php artisan db:seed --class=UserSeeder 
```
```bash
    php artisan db:seed --class=GameSeeder 
```
5. Démarer le serveur de développement php :

```bash
    php artisan serve
```

6. Démarer le serveur de développement node :

```bash
    npm run dev
```

5. Ouvrir [http://localhost:8000](http://localhost:8000) dans votre navigateur.

6. s'authentifier en tant que admin avec les crédetials suivantes:

<b>email:</b> suptech_admin@suptech-sante.ma <br />
<b>password:</b> password
