# SCSS Architecture

The theme keeps authored styles in `css/scss/` and compiles them into the generated files in `build/`. The entry point is `css/scss/main.scss`.

## Source Structure

```text
css/scss/
├── base/
│   ├── _variables.scss
│   ├── _z-index.scss
│   ├── _mixins.scss
│   ├── _custom-properties.scss
│   ├── _reset.scss
│   └── _base.scss
├── layout/
│   ├── _header.scss
│   ├── _footer.scss
│   ├── _main-content.scss
│   ├── _grid.scss
│   └── _style-guide.scss
├── components/
│   ├── _buttons.scss
│   ├── _forms.scss
│   ├── _card.scss
│   ├── _listing-detail.scss
│   └── _owner-profile.scss
├── pages/
│   └── _front-page.scss
├── utils/
│   └── _helpers.scss
└── main.scss
```

## Import Order

`main.scss` loads modules in this order:

1. Base variables, z-index values, mixins, custom properties, reset, and foundational styles.
2. Layout modules for the header, footer, main content, grid, and style guide.
3. Page-specific styles.
4. Components.
5. Utility helpers.

Keep new modules in the folder that owns their responsibility and add their `@use` declaration to `main.scss` when they should be compiled.

## Conventions

- Use BEM-style component names such as `.site-header__controls--mobile`.
- Use `.u-` for utility classes and `.js-` for JavaScript hooks.
- Prefer the shared variables, custom properties, mixins, and z-index map over repeated values.
- Keep styles mobile-first and use the shared responsive mixins where they encode a project breakpoint.
- Use the focus and reduced-motion patterns provided by the base mixins for interactive components.

## Build Workflow

From the theme root:

```bash
npm install
npm run start
npm run build
```

`@wordpress/scripts` compiles the SCSS entry point into `build/index.css` and `build/index-rtl.css`. The same build also produces the JavaScript bundle and asset metadata used by the theme enqueue logic.

Edit files under `css/scss/`, never generated files under `build/`. Review the compiled output after a production build and confirm that the theme loads the generated assets.

## Accessibility

The architecture supports focus styles, reduced-motion handling, semantic markup, and responsive layouts. Known contrast and touch-target follow-up items are tracked in [`scss/ACCESSIBILITY.md`](scss/ACCESSIBILITY.md); that checklist is a testing aid, not a claim that the entire rendered site has been audited.
