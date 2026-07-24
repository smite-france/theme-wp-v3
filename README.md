# SMFR Theme

Thème WordPress sur mesure pour **SMITE France** (communauté francophone SMITE & SMITE 2), basé sur [_tw](https://underscoretw.com/) (Underscores + Tailwind CSS 4 + esbuild).

## Prérequis

- Node.js ≥ 20 (voir `.nvmrc`)
- Composer (pour les outils de lint PHP)
- Docker / Podman avec docker-compose (pour l'environnement local)

## Installation

1. Copier le fichier d'environnement et le renseigner :

   ```bash
   cp .env.example .env
   ```

   Les identifiants MySQL doivent correspondre au `wp-config.php` du site local, et `WORDPRESS_PATH` doit pointer vers l'installation WordPress locale (miroir de production).

2. Installer les dépendances :

   ```bash
   npm install
   composer install   # optionnel : outils de lint PHP uniquement
   ```

3. Lancer l'environnement WordPress local :

   ```bash
   docker compose up -d
   ```

   - Site : <http://localhost:8080>
   - phpMyAdmin : <http://localhost:8081>

   Le dossier `theme/` est monté en direct dans `wp-content/themes/smfr`.

## Développement

```bash
npm run watch
```

surveille et recompile :

- `theme/style.css` (front) et `theme/style-editor.css` (éditeur) via Tailwind/PostCSS,
- `theme/js/*.min.js` via esbuild,
- `tailwind-intellisense.css` (support de l'extension Tailwind CSS de l'éditeur).

Les fichiers générés (`style.css`, `*.min.js`, …) sont ignorés par git : seuls les sources sont versionnés.

### Structure

| Chemin                            | Rôle                                             |
| --------------------------------- | ------------------------------------------------ |
| `theme/`                          | Le thème WordPress (templates, `functions.php`)  |
| `theme/inc/`                      | Logique PHP : template tags, hooks, Customizer   |
| `tailwind.css` + `tailwind/`      | Sources CSS (tokens dans `tailwind-theme.css`)   |
| `tailwind/custom/components/`     | Styles par composant (importés via glob)         |
| `javascript/`                     | Sources JS front et éditeur de blocs             |
| `node_scripts/zip.js`             | Génération du zip de production                  |

### Lint

```bash
npm run lint          # eslint + prettier
npm run lint-fix      # corrections automatiques
composer php:lint     # PHP_CodeSniffer (WordPress Coding Standards)
```

## Déploiement

```bash
npm run bundle
```

compile les assets en mode production puis génère `_smfr.zip` à la racine (avec un numéro de version horodaté). Téléverser le zip via **Apparence > Thèmes > Ajouter > Téléverser un thème**.

## Internationalisation

Domaine de texte : `_smfr`. Les chaînes du thème sont en français.
Pour régénérer le fichier POT : `composer make-pot`.
