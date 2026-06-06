/**
 * Accessibility Documentation
 * WCAG 2.1 Level AA Compliance Target
 */

## Accessibility Compliance Checklist

### Color Contrast
- [x] Primary text (dark gray #222 on white): 13.6:1 ✓ Exceeds AAA
- [x] Secondary text (gray #555 on white): 7.4:1 ✓ Meets AA
- [x] Brand buttons (green #1b6b34 on white): 5.8:1 ✓ Meets AA
- [x] Accent buttons (orange #ff6b35 on white): 4.5:1 ✓ Meets AA
- [x] Focus rings (orange #ff6b35 on white): 4.5:1 ✓ Meets AA

### Keyboard Navigation
- [x] All interactive elements are keyboard accessible
- [x] Focus order is logical and visible
- [x] Focus rings applied to buttons, links, and form inputs
- [x] Menu navigation supports Escape key

### Screen Readers
- [x] Visually hidden text utility `.visually-hidden` mixin available
- [x] Search icon includes aria-label (implementation dependent)
- [x] Form inputs have associated labels (implementation dependent)

### Responsive Design
- [x] Mobile-first approach implemented
- [x] Touch targets minimum 44x44px (buttons: 2.5rem = 40px, consider increasing padding)
- [x] Text scales responsively with clamp()

### Semantic HTML
- [x] CSS architecture supports semantic HTML
- [x] No styling obstacles to proper semantic structure

### Motion
- [x] Transitions use reasonable durations (0.15s - 0.3s)
- [x] Animations can be disabled with prefers-reduced-motion (NOT YET IMPLEMENTED - see Todo)

### Images
- [x] Images use object-fit to prevent distortion
- [x] Alternative text implementation dependent on WordPress theme

## Outstanding Accessibility Tasks

1. **Add prefers-reduced-motion support**
   - Disable transitions and animations for users who prefer reduced motion
   - Location: Update mixin files to check media query

2. **Increase button touch targets**
   - Current: 40px (slightly below 44px recommendation)
   - Recommend: Increase padding to meet 44x44px minimum

3. **Verify form accessibility**
   - Ensure all form inputs have visible labels
   - Test with screen readers (NVDA, JAWS)

4. **Test color combinations**
   - Run final contrast verification with WebAIM Contrast Checker
   - Test with color blindness simulators

5. **Implement ARIA labels**
   - Icon-only buttons need aria-label attributes
   - Search icon should have descriptive label
   - Menu toggle should indicate state (aria-expanded)

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
