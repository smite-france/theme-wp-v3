# AGENTS.md

Contexte pour les agents de code travaillant sur ce dépôt.

## Projet

Thème WordPress sur mesure pour **SMITE France** (communauté francophone SMITE / SMITE 2), basé sur [_tw](https://underscoretw.com/) (Underscores + Tailwind CSS 4 + esbuild). Thème classique (PHP), pas un thème bloc. Cible : PHP 7.4, WordPress ≥ 6.6. Interface en français.

## Commandes

- `npm run watch` — recompilation en continu (CSS front/éditeur/intellisense + JS).
- `npm run development` — build unique de développement.
- `npm run production` / `npm run bundle` — build de prod / zip `_smfr.zip`.
- `npm run lint` / `npm run lint-fix` — eslint + prettier.
- `composer php:lint` / `composer php:lint:autofix` — PHP_CodeSniffer (WPCS).
- `docker compose up -d` — WordPress local (site :8080, phpMyAdmin :8081), nécessite un `.env` (voir `.env.example`).

## Structure

- `theme/` — le thème livré (templates PHP, `functions.php`, `inc/`, `assets/`).
- `theme/inc/customizer.php` — options du Customizer (hero, vignette par défaut, bandeau d'info, réseaux sociaux) et helper `_smfr_customizer_image()`.
- `tailwind/tailwind-theme.css` — design tokens Tailwind ; les couleurs/containers viennent de `theme/theme.json`.
- `tailwind/custom/` — base, `@font-face` (fonts auto-hébergées dans `theme/assets/fonts/`), composants (un fichier par composant, importés via `@import-glob`, ordre alphabétique sans dépendance).
- `javascript/` — sources esbuild ; sortie dans `theme/js/*.min.js`.

## Conventions

- Préfixe global PHP : `_smfr` ; domaine de texte : `_smfr` ; chaînes en français.
- Standards PHP : WordPress Coding Standards (voir `phpcs.xml.dist`).
- Styles : Tailwind d'abord ; CSS custom en `@apply` dans `tailwind/custom/`.
- Les fichiers générés (`theme/style.css`, `theme/style-editor.css`, `tailwind-intellisense.css`, `*.min.js`, `_smfr.zip`) sont ignorés par git — ne pas les modifier à la main.
- Ne jamais committer de secrets : les identifiants locaux vivent dans `.env` (ignoré), jamais dans `docker-compose.yml`.
- `eslint-plugin-tailwindcss` lit `tailwind-intellisense.css` : le générer (`npm run development:tailwind:intellisense`) avant de lancer eslint sur une machine fraîche.
