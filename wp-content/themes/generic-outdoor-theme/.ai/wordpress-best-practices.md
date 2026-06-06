# WordPress Best Practices

## General Rules

Always write WordPress code that is:

- Secure
- Readable
- Maintainable
- Accessible
- Theme-appropriate

Prefer WordPress APIs instead of custom solutions.

## Escaping Output

Escape dynamic output before displaying it.

Use:

```php
esc_html( $text );
esc_url( $url );
esc_attr( $attribute );
wp_kses_post( $html );