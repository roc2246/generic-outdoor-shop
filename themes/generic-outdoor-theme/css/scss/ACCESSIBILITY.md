/**
 * Accessibility Documentation
 * WCAG 2.1 Level AA Compliance Target
 */

## Accessibility Compliance Checklist

### Color Contrast
- [x] Primary text (dark gray #222 on white): 15.91:1 ✓ Exceeds AAA
- [x] Secondary text (gray #555 on white): 7.4:1 ✓ Meets AA
- [x] Brand buttons (green #1b6b34 on white): 6.56:1 ✓ Meets AA
- [ ] Accent buttons (orange #ff6b35 on white): 2.84:1 ✗ Does not meet AA
- [ ] Focus rings (orange #ff6b35 on white): 2.84:1 ✗ Verify against WCAG 2.2 focus appearance requirements

### Keyboard Navigation
- [x] All interactive elements are keyboard accessible
- [x] Focus order is logical and visible
- [x] Focus rings applied to buttons, links, and form inputs
- [x] Menu navigation supports Escape key

### Screen Readers
- [x] Visually hidden text utility `.visually-hidden` mixin available
- [x] Search and menu controls expose accessible names and state
- [x] Search input has an associated label

### Responsive Design
- [x] Mobile-first approach implemented
- [ ] Touch targets meet the 44x44px minimum (some controls are 2.5rem = 40px)
- [x] Text scales responsively with clamp()

### Semantic HTML
- [x] CSS architecture supports semantic HTML
- [x] No styling obstacles to proper semantic structure

### Motion
- [x] Transitions use reasonable durations (0.15s - 0.3s)
- [x] Transitions respect `prefers-reduced-motion`

### Images
- [x] Images use object-fit to prevent distortion
- [x] Alternative text implementation dependent on WordPress theme

## Outstanding Accessibility Tasks

1. **Improve accent contrast**
   - Replace or darken `#ff6b35` where white text or focus indicators are used

2. **Increase button touch targets**
   - Current: 40px (slightly below 44px recommendation)
   - Recommend: Increase padding to meet 44x44px minimum

3. **Complete assistive technology verification**
   - Test the full theme with screen readers (NVDA, JAWS)

4. **Verify color combinations**
   - Re-run contrast verification after updating the accent color
   - Test with color blindness simulators

## Testing Tools and Resources

- WebAIM Contrast Checker: https://webaim.org/resources/contrastchecker/
- Lighthouse Accessibility Audit: Built into Chrome DevTools
- WAVE Browser Extension: https://wave.webaim.org/
- axe DevTools: https://www.deque.com/axe/devtools/
- NVDA Screen Reader: https://www.nvaccess.org/

## Build Process Integration

Add accessibility checks to npm scripts:
```json
{
  "test:a11y": "lighthouse --only-categories=accessibility --output=json",
  "test:contrast": "npm run build && node scripts/contrast-checker.js"
}
```

Last Updated: June 6, 2026
WCAG 2.1 Level: AA (Target)
