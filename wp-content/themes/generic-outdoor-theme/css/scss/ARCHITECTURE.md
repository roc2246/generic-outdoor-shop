/**
 * SCSS Architecture Implementation Guide
 * Generic Outdoor Theme - Best Practices and Usage
 * 
 * Last Updated: June 6, 2026
 */

# SCSS Architecture Guide

## Overview

The Generic Outdoor Theme SCSS architecture has been refactored to follow modern CSS best practices with improved maintainability, accessibility, and runtime customization capabilities.

## What's Changed

### 1. **CSS Custom Properties** (NEW)
**File:** `base/_custom-properties.scss`

All theme-related colors, typography, spacing, and shadows are now exposed as CSS custom properties at the `:root` level for runtime customization.

**Why:** Allows dynamic theme changes via JavaScript without recompiling SCSS.

**Examples:**
```scss
// In components, use CSS variables instead of SCSS variables:
.button {
  background: var(--color-brand);  // ✓ Use this
  background: $brand-color;         // ✗ Avoid for theme colors
}

// Colors available:
--color-brand, --color-accent, --color-muted
--color-text, --color-text-secondary
--color-background, --color-border

// Spacing available:
--spacing-xs, --spacing-sm, --spacing-md, --spacing-lg, --spacing-xl, --spacing-xxl
```

**Customization from JavaScript:**
```javascript
// Change theme at runtime
document.documentElement.style.setProperty('--color-brand', '#d32f2f');
document.documentElement.style.setProperty('--color-accent', '#ffc107');
```

### 2. **Z-Index Management** (NEW)
**File:** `base/_z-index.scss`

Centralized z-index scale prevents stacking context conflicts.

**Scale:**
```scss
$z-index: (
  base: 0,
  dropdown: 100,
  sticky: 500,
  modal-backdrop: 900,
  modal: 1000,
  tooltip: 2000,
  notification: 2100
);
```

**Usage:**
```scss
// ✓ Correct - use the z() function
.site-navigation {
  z-index: z(modal);
}

// ✗ Avoid - hardcoded values
.site-navigation {
  z-index: 1000;
}
```

### 3. **Enhanced Mixins with Accessibility**

#### **transition() - Respects prefers-reduced-motion**
```scss
// Automatically disables transitions for users who prefer reduced motion
@mixin transition($property: all, $duration: $transition-normal) {
  transition: $property $duration;
  
  @media (prefers-reduced-motion: reduce) {
    transition: none;
  }
}
```

#### **focus-ring() - Cross-browser Focus States**
```scss
// Now includes fallback for browsers without outline-offset support
@mixin focus-ring($color: $accent-color, $offset: 2px) {
  outline: 2px solid $color;
  outline-offset: $offset;
  
  @supports not (outline-offset: 0) {
    box-shadow: 0 0 0 3px rgba($color, 0.5);
  }
}
```

### 4. **Expanded Utility System**

**File:** `utils/_helpers.scss`

Utilities are now generated from the spacing scale for consistency:

```scss
// Generated spacing utilities with all spacing values
.u-m-sm, .u-m-md, .u-m-lg, .u-m-xl, .u-m-xxl
.u-mt-sm, .u-mt-md, .u-mt-lg, etc.
.u-mb-sm, .u-mb-md, .u-mb-lg, etc.
.u-p-sm, .u-p-md, .u-p-lg, etc.
.u-px-sm, .u-py-sm, etc.

// New utility categories:
Opacity:     .u-opacity-0, .u-opacity-25, .u-opacity-50, .u-opacity-75, .u-opacity-100
Shadows:     .u-shadow-sm, .u-shadow-md, .u-shadow-lg, .u-shadow-xl, .u-shadow-none
Borders:     .u-border, .u-border-t, .u-border-b, .u-rounded, .u-rounded-full
Visibility:  .u-overflow-hidden, .u-whitespace-nowrap, .u-truncate
Sizing:      .u-w-full, .u-h-full, .u-max-w-full
Position:    .u-relative, .u-absolute, .u-fixed
Flexbox:     .u-flex-gap-sm, .u-flex-gap-md, .u-flex-gap-lg, .u-flex-column, .u-flex-wrap
A11y:        .u-sr-only (visually hidden, screen-reader only)
```

### 5. **Component Documentation**

All components now include HTML examples showing proper usage:

```scss
/**
 * Card Component
 * 
 * @example
 * <div class="card">
 *   <a class="card__image-link" href="#">
 *     <img src="..." alt="..." />
 *   </a>
 *   <div class="card__content">
 *     <h3>Title</h3>
 *     <p class="card__excerpt">Description</p>
 *     <button class="button">Learn More</button>
 *   </div>
 * </div>
 */
```

### 6. **Consistent Grid Implementation**

Grid layout now uses the `respond()` mixin consistently:

```scss
// Old approach (inconsistent)
@media (min-width: 48rem) { /* ... */ }

// New approach (consistent)
@include respond(tablet) { /* ... */ }
```

## Best Practices

### ✓ DO

1. **Use CSS variables for theme colors**
   ```scss
   color: var(--color-text);           // ✓ Good
   background: var(--color-brand);     // ✓ Good
   ```

2. **Use the z() function for z-index values**
   ```scss
   z-index: z(modal);
   z-index: z(dropdown);
   ```

3. **Use the respond() mixin for breakpoints**
   ```scss
   @include respond(tablet) { /* ... */ }
   @include respond(laptop) { /* ... */ }
   ```

4. **Use generated spacing utilities**
   ```scss
   margin: var(--spacing-md);
   padding: var(--spacing-lg);
   ```

5. **Add focus-ring to interactive elements**
   ```scss
   &:focus {
     @include focus-ring();
   }
   ```

6. **Respect prefers-reduced-motion**
   ```scss
   @include transition(opacity, $transition-normal);
   // Automatically respects user preferences
   ```

### ✗ DON'T

1. **Hardcode color values**
   ```scss
   color: #1b6b34;  // ✗ Not themeable
   ```

2. **Use scattered z-index values**
   ```scss
   z-index: 1000;   // ✗ Not managed
   ```

3. **Mix SCSS and CSS variables inconsistently**
   ```scss
   color: var(--color-text);
   background: $brand-color;  // ✗ Inconsistent
   ```

4. **Hardcode breakpoints in components**
   ```scss
   @media (min-width: 768px) { /* ... */ }  // ✗ Use respond()
   ```

5. **Ignore accessibility requirements**
   ```scss
   &:focus { /* empty */ }  // ✗ Add focus-ring
   ```

## Migration Guide

If you're working with existing SCSS code:

### Step 1: Replace SCSS variables with CSS custom properties
```scss
// Before
color: $text-color;
background: $brand-color;

// After
color: var(--color-text);
background: var(--color-brand);
```

### Step 2: Update z-index values
```scss
// Before
z-index: 1000;
z-index: 1100;

// After
z-index: z(modal);
z-index: z(base);
```

### Step 3: Use utility values from spacing scale
```scss
// Before
margin: 1rem;
padding: 0.5rem;

// After
margin: var(--spacing-md);
padding: var(--spacing-sm);
```

### Step 4: Use respond() mixin consistently
```scss
// Before
@media (min-width: 768px) { /* ... */ }

// After
@include respond(tablet) { /* ... */ }
```

## Testing Accessibility

### Color Contrast
All color combinations have been verified to meet WCAG 2.1 AA standards. See `ACCESSIBILITY.md` for detailed contrast ratios.

### Keyboard Navigation
Test using only the Tab and Enter keys:
- Focus should be visible on all interactive elements
- Tab order should be logical
- All functionality should be accessible via keyboard

### Motion Preferences
Test on macOS/Windows with reduced motion enabled:
- All transitions should be disabled
- Animations should be minimal or absent
- Content should remain accessible

### Screen Readers
Test with NVDA (Windows) or JAWS:
- Use `.u-sr-only` for screen-reader-only content
- All icon-only buttons should have `aria-label`
- Form inputs should have associated labels

## File Organization

```
scss/
├── base/
│   ├── _variables.scss          # Design tokens (SCSS variables)
│   ├── _custom-properties.scss  # CSS custom properties (runtime theme)
│   ├── _z-index.scss            # Z-index scale management
│   ├── _mixins.scss             # Reusable functions and mixins
│   ├── _reset.scss              # Browser reset
│   └── _base.scss               # Base element styles
├── layout/
│   ├── _header.scss
│   ├── _footer.scss
│   ├── _main-content.scss
│   └── _grid.scss
├── components/
│   ├── _buttons.scss
│   ├── _card.scss
│   ├── _forms.scss
│   └── _listing-detail.scss
├── utils/
│   └── _helpers.scss            # Utility classes (expanded)
├── main.scss                    # Entry point
└── ACCESSIBILITY.md             # Accessibility documentation
```

## Performance Considerations

### CSS Size
The expanded utilities system increases CSS size slightly (~2-3KB gzipped). This is offset by:
- Better consistency
- Fewer custom styles needed in HTML
- Improved maintainability

### Runtime Customization
CSS custom properties are declared at `:root`, which:
- Has negligible performance impact
- Enables efficient theme switching
- Allows progressive enhancement

## Future Enhancements

Recommended next steps:

1. **Dark Mode Support**
   ```scss
   @media (prefers-color-scheme: dark) {
     :root {
       --color-text: #f5f5f5;
       --color-background: #1a1a1a;
       // ... other dark theme values
     }
   }
   ```

2. **High Contrast Mode**
   ```scss
   @media (prefers-contrast: more) {
     :root {
       --color-brand: #0033cc;  // Higher contrast
       // ... adjust all colors
     }
   }
   ```

3. **Responsive Utility Variants**
   ```scss
   .u-mb@tablet { margin-bottom: var(--spacing-lg); }
   .u-p@mobile { padding: var(--spacing-sm); }
   ```

4. **Animation Library**
   Create dedicated `_animations.scss` with standardized keyframe definitions.

## Questions or Issues?

See `ACCESSIBILITY.md` for accessibility compliance details.
Refer to individual component files for HTML examples and BEM structure details.
