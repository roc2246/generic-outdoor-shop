# SCSS Architecture Guide
## Generic Outdoor Theme

### Overview

This document outlines the SCSS architecture and organization for the Generic Outdoor WordPress theme. The codebase follows modern CSS organization practices including SMACSS (Scalable and Modular Architecture for CSS) and BEM (Block, Element, Modifier) naming conventions.

---

## Directory Structure

```
scss/
├── base/
│   ├── _variables.scss      # Design tokens (colors, typography, spacing, shadows)
│   ├── _mixins.scss         # Reusable SCSS functions and utilities
│   ├── _reset.scss          # Browser reset and normalization
│   └── _base.scss           # Foundational document styles and typography
├── layout/
│   ├── _header.scss         # Site header and navigation
│   ├── _footer.scss         # Site footer
│   ├── _main-content.scss   # Content containers and page sections
│   └── _grid.scss           # Grid layout system
├── components/
│   ├── _buttons.scss        # Button styles and variants
│   ├── _forms.scss          # Form elements and search overlay
│   ├── _card.scss           # Card component
│   └── _listing-detail.scss # Product/service detail view
├── utils/
│   └── _helpers.scss        # Utility classes for common patterns
└── main.scss                # Main entry point that imports all modules
```

---

## Key Features

### 1. **Design Tokens System** (`_variables.scss`)

All design decisions are centralized in a single variables file:

```scss
// Color Palette
$brand-color: #1b6b34;
$accent-color: #ff6b35;

// Spacing Scale
$spacing: (
  xs: 0.25rem,
  sm: 0.5rem,
  md: 1rem,
  lg: 1.5rem,
  xl: 2rem,
  xxl: 4rem
);

// Shadow System
$shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
$shadow-md: 0 4px 8px rgba(0, 0, 0, 0.12);
$shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.16);

// Transitions
$transition-fast: 0.15s ease;
$transition-normal: 0.2s ease;
$transition-slow: 0.3s ease;
```

**Benefits:**
- Single source of truth for design consistency
- Easy theme customization
- Reduced code duplication

### 2. **Reusable Mixins** (`_mixins.scss`)

Common patterns are abstracted into mixins for DRY code:

```scss
// Responsive container
@include container();

// Mobile-first breakpoints
@include respond(tablet) { ... }

// Accessibility helpers
@include visually-hidden();
@include focus-ring();

// Smooth transitions
@include transition(property, duration);
```

**Benefits:**
- Consistent implementation of common patterns
- Easier maintenance
- Improved readability

### 3. **Accessibility-First Approach**

Every interactive element includes:

- **Focus states** for keyboard navigation
- **Color contrast** ratios that meet WCAG AA standards
- **Semantic HTML** support
- **Reduced motion** considerations

Example:
```scss
.button {
  &:focus {
    @include focus-ring($accent-color, 2px);
  }
}
```

### 4. **Component-Based Organization**

Each UI component is self-contained:

```
_buttons.scss    → All button styles and variants
_card.scss       → Card layout and states
_forms.scss      → Form elements and overlays
_listing-detail.scss → Product detail page layout
```

**Benefits:**
- Easy to locate and modify styles
- Simple to add new components
- Clear component dependencies

### 5. **Utility Classes** (`_helpers.scss`)

Comprehensive utility system for rapid prototyping:

```scss
// Display utilities
.u-hidden, .u-flex, .u-grid, .u-block

// Spacing utilities
.u-mb, .u-mt, .u-p, .u-px, .u-py

// Text utilities
.u-text-center, .u-font-bold, .u-font-medium

// Flexbox utilities
.u-flex-center, .u-flex-between
```

**Benefits:**
- Faster development
- Consistent spacing and alignment
- Low specificity for easy overrides

### 6. **CSS Variables Integration**

SCSS variables are exported as CSS custom properties for runtime customization:

```scss
:root {
  --brand-color: #1b6b34;
  --accent-color: #ff6b35;
  --text-color: #222;
  --font-stack: 'Segoe UI', Roboto, sans-serif;
}
```

This enables:
- Theme customization without recompilation
- JavaScript-accessible color values
- Dynamic theme switching

---

## Naming Conventions

### BEM (Block, Element, Modifier)

```scss
.site-header { ... }                    // Block
.site-header__controls { ... }          // Element
.site-header__controls--mobile { ... }  // Modifier
```

### Prefixes

- `.u-` = Utility class
- `.js-` = JavaScript hook (no styling)
- No prefix = Component or layout class

---

## Responsive Design Pattern

Mobile-first approach with semantic breakpoint names:

```scss
// Mobile styles first (default)
.card {
  grid-template-columns: 1fr;
}

// Tablet and up
@include respond(tablet) {
  .card {
    grid-template-columns: repeat(2, 1fr);
  }
}

// Desktop and up
@include respond(laptop) {
  .card {
    grid-template-columns: repeat(3, 1fr);
  }
}
```

Available breakpoints:
- `mobile-sm`: 320px
- `mobile`: 480px
- `tablet`: 768px
- `laptop`: 1024px
- `desktop`: 1280px
- `desktop-lg`: 1440px

---

## Performance Considerations

### File Size Management

- Organized modules prevent unnecessary imports
- Utility classes generated systematically
- Minimal nesting prevents CSS bloat

### Transition Timing

```scss
$transition-fast: 0.15s ease;      // UI feedback
$transition-normal: 0.2s ease;     // Standard animations
$transition-slow: 0.3s ease;       // Overlays, large changes
```

Uses consistent timing for professional feel while maintaining performance.

---

## Best Practices

### 1. **Always Use Variables**
```scss
// ✓ Good
background: $brand-color;
padding: map.get($spacing, md);

// ✗ Avoid
background: #1b6b34;
padding: 1rem;
```

### 2. **Leverage Mixins**
```scss
// ✓ Good
@include respond(tablet) { ... }
@include transition(all, $transition-normal);

// ✗ Avoid
@media (min-width: 768px) { ... }
transition: all 0.2s ease;
```

### 3. **Follow BEM Naming**
```scss
// ✓ Good
.card__content { ... }
.button--secondary { ... }

// ✗ Avoid
.card-content { ... }
.button-secondary { ... }
```

### 4. **Use Focus States**
```scss
// ✓ Good - Accessible
&:focus {
  @include focus-ring();
}

// ✗ Avoid - Not accessible
// (no focus state)
```

### 5. **Organize by Specificity**
```scss
// Lower specificity
.component { ... }

// Element-level
.component__element { ... }

// Modifiers and states
.component--modifier { ... }
.component:hover { ... }
```

---

## Adding New Styles

### Adding a New Component

1. Create file: `components/_new-component.scss`
2. Use SCSS modules and BEM naming
3. Include documentation block
4. Import in `main.scss`

```scss
/**
 * New Component
 * Brief description of purpose
 */

@use "../base/variables" as *;
@use "../base/mixins" as *;

.new-component {
  // Styles
}
```

### Adding Utility Classes

Update `utils/_helpers.scss`:
```scss
.u-new-utility { /* styles */ }
```

### Extending Spacing Scale

Update `base/_variables.scss`:
```scss
$spacing: (
  // ... existing scales
  new-scale: 3.5rem
);
```

---

## Color Palette

The theme uses a cohesive color scheme:

- **Brand Color**: `#1b6b34` - Primary green for outdoor theme
- **Accent Color**: `#ff6b35` - Warm orange for calls-to-action
- **Text**: `#222` - Dark gray for readability
- **Muted**: `#f5f5f5` - Light gray for backgrounds
- **Background**: `#fff` - Clean white for content

---

## Typography

- **Font Stack**: `Segoe UI, Roboto, Helvetica, Arial` (system fonts for optimal performance)
- **Base Size**: `1rem` (16px)
- **Scale**: `1rem`, `1.25rem`, `2rem`
- **Line Height**: `1.6` (optimal readability)

---

## Shadow System

Consistent shadow depth for visual hierarchy:

```scss
$shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);     // Subtle elevation
$shadow-md: 0 4px 8px rgba(0, 0, 0, 0.12);     // Standard cards
$shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.16);    // Interactive states
$shadow-xl: 0 12px 24px rgba(0, 0, 0, 0.2);    // Major overlays
```

---

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- CSS Grid and Flexbox
- CSS Variables
- CSS Transitions

---

## Maintenance Tips

1. **Keep variables centralized** - Update `_variables.scss` for theme changes
2. **Use mixins consistently** - Avoid hardcoded values
3. **Maintain BEM structure** - Makes styles easy to locate
4. **Document complex styles** - Add comments for non-obvious implementations
5. **Test accessibility** - Verify focus states and color contrast

---

## Resources

- **SMACSS**: https://smacss.com/
- **BEM Methodology**: https://getbem.com/
- **Sass Documentation**: https://sass-lang.com/documentation
- **WCAG Accessibility**: https://www.w3.org/WAI/WCAG21/quickref/

---

## Version History

- **v1.0** - Initial architecture with base components and utilities
  - Established variable system with design tokens
  - Implemented accessibility-first approach with focus states
  - Created comprehensive utility class library
  - Documented best practices and patterns
