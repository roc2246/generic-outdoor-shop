# Coding Standards

## PHP / WordPress

Use:
- WordPress escaping functions
- `esc_html()`
- `esc_url()`
- `esc_attr()`
- `wp_kses_post()`
- `sanitize_text_field()` when handling input

Prefer:
- Reusable template parts
- Clear function names
- WordPress hooks and filters
- Simple readable logic

Avoid:
- Unescaped output
- Hardcoded URLs
- Inline styles
- Mixing too much HTML and logic

## SCSS

Use:
- Mobile-first styles
- `rem` units when possible
- CSS custom properties for theme values
- Grid for page layouts
- Flexbox for component alignment
- Component-based partials

Avoid:
- Overly specific selectors
- Random one-off styles
- Large files with unrelated styles
- Styling generated build files directly

## JavaScript

Use:
- Small focused modules
- Clear event listeners
- Progressive enhancement
- Accessible interactions

Avoid:
- jQuery unless specifically needed
- Global variables when avoidable
- Overcomplicated state logic