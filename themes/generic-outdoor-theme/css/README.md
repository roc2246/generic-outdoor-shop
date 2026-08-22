# CSS and SCSS Guide

This directory contains SCSS source files for the theme.

## Source of Truth

- SCSS entry: `css/scss/main.scss`
- Architecture docs:
  - `css/SCSS_ARCHITECTURE.md`
  - `css/scss/ARCHITECTURE.md`

## Folder Structure

- `scss/base/` - variables, custom properties, mixins, reset, foundational styles.
- `scss/layout/` - header, footer, layout containers, grid.
- `scss/components/` - reusable UI components.
- `scss/pages/` - page-specific styles.
- `scss/utils/` - utility helpers.

## Build Output

SCSS is compiled by `@wordpress/scripts` into the theme `build/` folder:

- `build/index.css`
- `build/index-rtl.css`

Do not edit files in `build/` manually; update SCSS source files and rebuild.

## Build Commands

From theme root:

- `npm run start` for watch mode
- `npm run build` for production build
