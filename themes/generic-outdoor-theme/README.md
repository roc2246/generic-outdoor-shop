# Generic Outdoor Theme

A custom WordPress theme for an outdoor shop website. The theme includes custom post type presentation, a custom REST search route, and a modular SCSS architecture compiled through `@wordpress/scripts`.

## Project Purpose

This theme is designed to be:

- Maintainable for long-term WordPress development.
- Easy to onboard for another developer or agency.
- Practical for local development and production build workflows.

## Core Features

- Custom REST API search endpoint at `wp-json/genericOutdoor/v1/search`.
- Product and service presentation templates with reusable template parts.
- ACF field integration through centralized constants in `inc/acf-fields.php`.
- Modular SCSS architecture (`base`, `layout`, `components`, `pages`, `utils`).

Site-wide content types and custom authentication routes are registered by the
MU-plugins in `wp-content/mu-plugins/`. See the [wp-content handoff guide](../../README.md)
for ownership boundaries, route slugs, plugin responsibilities, and deployment notes.

## Technology Stack

- WordPress / PHP
- JavaScript (bundled with `@wordpress/scripts`)
- SCSS (compiled into `build/index.css`)
- Webpack (via `wp-scripts`)

## Requirements

- WordPress installation with this theme available under `wp-content/themes/generic-outdoor-theme`.
- Node.js and npm available locally.
- Advanced Custom Fields plugin active if product/service custom fields are required.
- The `Generic Outdoor MU Post Types` MU-plugin present so product and service content remains available independently of the theme.

## Setup

1. Install dependencies:

   ```bash
   npm install
   ```

2. Start development watch mode:

   ```bash
   npm run start
   ```

3. Create a production build:

   ```bash
   npm run build
   ```

## Build and Asset Workflow

- Source SCSS entry point: `css/scss/main.scss`
- Source JavaScript entry point: `src/index.js`
- Build outputs:
  - `build/index.css`
  - `build/index-rtl.css`
  - `build/index.js`
  - `build/index.asset.php`

Theme assets are enqueued from `functions.php` using the generated build files.

## Project Structure

- `functions.php`: Theme setup, asset enqueueing, shared UI helpers.
- `inc/`: Supporting PHP modules:
  - `acf-fields.php`: ACF field constants.
  - `search-route.php`: REST search route and response shaping.
- `template-parts/`: Reusable theme partials.
- `src/`: JavaScript entry point and frontend modules.
- `css/scss/`: SCSS source architecture.
- `build/`: Compiled frontend assets.

The SCSS source structure is documented in [`css/SCSS_ARCHITECTURE.md`](css/SCSS_ARCHITECTURE.md).
Accessibility-specific checks and known follow-up work are documented in
[`css/scss/ACCESSIBILITY.md`](css/scss/ACCESSIBILITY.md).

## REST Search Endpoint Notes

- Route: `wp-json/genericOutdoor/v1/search`
- Request arg: `term` (minimum 2 characters)
- Includes basic request throttling and response normalization.
- Returns grouped results for general info, products, and services.

## Maintenance Notes

- Keep SCSS changes in `css/scss/`; do not edit compiled files in `build/` manually.
- Keep function docblocks aligned with actual behavior when updating defaults.
- Keep site-wide post types and authentication routes in `wp-content/mu-plugins/`, not in theme templates.
- Rebuild the theme after source changes and verify the generated assets before deployment.
- Update this README whenever build paths, required plugins, or architecture responsibilities change.

## License

GPLv2 or later.