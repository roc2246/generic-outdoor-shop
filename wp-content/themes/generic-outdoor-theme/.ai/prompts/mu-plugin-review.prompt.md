# WordPress MU-Plugin Review

## Required Project Context

Before reviewing the code, use the standards and requirements defined in:

- .ai/project-context.md
- .ai/coding-standards.md
- .ai/style-guide.md
- .ai/wordpress-best-practices.md
- .ai/employer-review-checklist.md

If any project-specific instructions conflict with generic WordPress advice, prioritize the project files above.

---

## Context

Review the provided WordPress MU-plugin (Must Use Plugin).

Assume the code contains site-wide functionality that automatically loads for every request.

The MU-plugin may contain:

- Business logic
- Custom integrations
- Security functionality
- Custom authentication
- API integrations
- Utility functions
- Content restrictions
- Admin customizations
- Performance optimizations
- Site-wide hooks and filters

## Task

Review this MU-plugin as a senior WordPress developer working at an agency.

Evaluate:

- Architecture
- Separation of concerns
- Maintainability
- Security
- Scalability
- Hook usage
- Filter usage
- Namespacing
- Dependency management
- Error handling
- Performance
- Agency readiness

## Return Format

1. Overall Score (1-10)
2. What Is Good
3. Major Concerns
4. Security Concerns
5. Architecture Concerns
6. Performance Concerns
7. Suggested Refactoring
8. Agency Readiness

Review for:

- Escaping
- Sanitization
- Validation
- Capability checks
- Hook design
- Reusability
- Long-term maintainability

Prioritize:

1. Maintainability
2. Security
3. Reliability
4. Simplicity
5. Reusability

Flag anything that would become difficult to maintain over time.

Do not recommend enterprise architecture unless justified.