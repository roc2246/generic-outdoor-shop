# WordPress Content Directory

This directory contains the site-specific WordPress theme, must-use plugins, installed plugins, uploads, and backup tooling for the Generic Outdoor Shop site.

## Ownership

### Custom theme

`themes/generic-outdoor-theme/` controls presentation and frontend behavior:

- Templates and reusable template parts for the site, products, and services.
- Theme setup, navigation, login styling, and asset enqueueing in `functions.php`.
- ACF field-name constants in `inc/acf-fields.php`.
- The public REST search endpoint in `inc/search-route.php`.
- SCSS source in `css/scss/` and JavaScript source in `src/`.
- Compiled assets in `build/`.

The theme depends on Advanced Custom Fields when product or service custom fields are used. Product and service registration does not belong to the theme and is provided by the MU-plugin below.

### Must-use plugins

`mu-plugins/` loads automatically and is not managed through the normal Plugins screen:

- `generic-outdoor-post-types.php` registers the public `product` and `service` post types and the hierarchical `product_type` taxonomy. These are site content-model features and survive theme changes.
- `custom-auth-routes.php` provides the `/my-logout/` and `/sign-up/` routes and filters WordPress logout and registration URLs.

Changes to MU-plugins take effect immediately. Test route and content-model changes in a local environment before deployment.

### Installed plugins

The installed plugins directory currently includes:

- Advanced Custom Fields: custom fields used by the theme.
- Members: role and capability management.
- WP Hide & Security Enhancer: configurable login URL behavior.
- All-in-One WP Migration and Duplicator: migration and backup utilities.

Confirm activation, configuration, and version requirements in the local WordPress admin before relying on a plugin feature. Backup and migration plugins should be treated as operational tooling rather than application dependencies.

## Content Model

The MU-plugin exposes these public REST-enabled types:

| Type | Archive | Rewrite slug | Purpose |
| --- | --- | --- | --- |
| `product` | Yes | `/products/` | Shop products |
| `service` | Yes | `/services/` | Services offered by the shop |

The `product_type` taxonomy is hierarchical, public, REST-enabled, and uses `/product-type/` as its rewrite slug.

The theme uses these ACF field names:

- Products: `product_name`, `price`, `product_description`, `related_products`.
- Services: `service_name`, `service_price`, `service_description`, `related_services`.

After changing post-type or taxonomy rewrite settings, refresh permalinks from WordPress Settings > Permalinks. Do not flush rewrite rules on every request.

## REST Search

The theme registers a public read-only endpoint at:

`/wp-json/genericOutdoor/v1/search`

It requires a `term` parameter with at least two characters, searches published posts, pages, products, and services, includes matching product types, and returns grouped `generalInfo`, `products`, and `services` results. Requests are rate-limited to 30 per minute per request identity by default. The permission and rate-limit behavior can be changed through the documented filters in `themes/generic-outdoor-theme/inc/search-route.php`.

## Theme Development

From `themes/generic-outdoor-theme/`:

```bash
npm install
npm run start
npm run build
```

- SCSS entry point: `css/scss/main.scss`.
- JavaScript entry point: `src/index.js`.
- Build output: `build/index.css`, `build/index.js`, and `build/index.asset.php`.
- Edit source files, not generated files in `build/`.
- `src/admin.js` contains admin-specific source code; confirm bundling requirements before changing its role.

See the theme [README](themes/generic-outdoor-theme/README.md) and [SCSS guide](themes/generic-outdoor-theme/css/SCSS_ARCHITECTURE.md) for implementation details.

## Files and Operations

- `uploads/` contains media and is runtime content, not source code.
- `ai1wm-backups/` and `backups-dup-lite/` contain backup-plugin data and must be protected from public access according to the local and production server configuration.
- `upgrade/` contains WordPress upgrade data and should not be edited manually.
- Do not commit credentials, database exports, backup archives, or generated runtime data.

Before deployment:

1. Build the theme with `npm run build`.
2. Verify the generated assets exist and load on the target site.
3. Confirm required plugins and MU-plugins are present.
4. Test product, service, taxonomy, login, registration, logout, and search routes.
5. Take and verify a restorable backup before content-model or migration work.
