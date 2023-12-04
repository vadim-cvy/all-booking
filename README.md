# Boilerplate for WP theme

## Dependencies:
* Astra
* Beaver Builder
* WP All In One Migration

---

## Development

### PHP
1. All includes must be stored at `/inc`.
2. Autoload follows PSR-4 standard. Ex: `\JBK\DirName\ClassName` = `./inc/DirName/ClassName.php`.
3. See `composer.json` >> `repositories` to view my utility packages which will help in dev process and will allow you to keep the same structure and common code base between different projects.

### JS & CSS
1. `/assets/src/css/{entry-point-name}/index.scss` will be compiled into `/assets/dist/css/{entry-point-name}.css`.
2. `/assets/src/js/{entry-point-name}/index.ts` will be compiled into `/assets/dist/js/{entry-point-name}/index.{dev|prod}.js`.
3. Commands
    * `npm run dev` - watches source files changes and compiles dev assets. Should be used during development.
    * `npm run build` - generates production ready assets.