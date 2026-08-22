<?php
/**
 * Template Name: Style Guide
 * Description: Component showcase and design system documentation
 *
 * This page displays all reusable components, typography styles,
 * and design tokens used throughout the theme.
 *
 * @package Generic_Outdoor_Theme
 */

get_header();
?>

<div class="site-main style-guide">
	<div class="container">

		<!-- ============================================ -->
		<!-- HEADER SECTION                              -->
		<!-- ============================================ -->
		<div class="page-section style-guide__intro">
			<h1 class="style-guide__title">Style Guide</h1>
			<p class="style-guide__subtitle">Component library and design system for Generic Outdoor Theme</p>
			<p class="style-guide__description">
				This page showcases all reusable components, design tokens, and patterns used throughout the theme.
				Use this as a reference for consistency and as a quick test bed for new components.
			</p>
		</div>

		<!-- ============================================ -->
		<!-- COLOR PALETTE SECTION                       -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Color Palette</h2>
			<p class="style-guide__section-description">
				Core colors used throughout the design system
			</p>

			<div class="color-grid">
				<div class="color-swatch">
					<div class="color-swatch__color" style="background-color: #1b6b34;"></div>
					<h3 class="color-swatch__name">Brand Color</h3>
					<code class="color-swatch__code">#1b6b34</code>
					<p class="color-swatch__usage">Primary green for buttons, links, and key UI elements</p>
				</div>

				<div class="color-swatch">
					<div class="color-swatch__color" style="background-color: #ff6b35;"></div>
					<h3 class="color-swatch__name">Accent Color</h3>
					<code class="color-swatch__code">#ff6b35</code>
					<p class="color-swatch__usage">Orange for calls-to-action and secondary buttons</p>
				</div>

				<div class="color-swatch">
					<div class="color-swatch__color" style="background-color: #222;"></div>
					<h3 class="color-swatch__name">Text Color</h3>
					<code class="color-swatch__code">#222</code>
					<p class="color-swatch__usage">Primary text and headings</p>
				</div>

				<div class="color-swatch">
					<div class="color-swatch__color" style="background-color: #555;"></div>
					<h3 class="color-swatch__name">Text Secondary</h3>
					<code class="color-swatch__code">#555</code>
					<p class="color-swatch__usage">Secondary text and descriptions</p>
				</div>

				<div class="color-swatch">
					<div class="color-swatch__color" style="background-color: #f5f5f5; border: 1px solid #ddd;"></div>
					<h3 class="color-swatch__name">Muted</h3>
					<code class="color-swatch__code">#f5f5f5</code>
					<p class="color-swatch__usage">Background color for sections</p>
				</div>

				<div class="color-swatch">
					<div class="color-swatch__color" style="background-color: #fff; border: 1px solid #ddd;"></div>
					<h3 class="color-swatch__name">Background</h3>
					<code class="color-swatch__code">#fff</code>
					<p class="color-swatch__usage">Main background and card backgrounds</p>
				</div>
			</div>
		</section>

		<!-- ============================================ -->
		<!-- TYPOGRAPHY SECTION                          -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Typography</h2>
			<p class="style-guide__section-description">
				Text styles and font scales
			</p>

			<div class="style-guide__typography">
				<div class="style-guide__typography-item">
					<h1>Heading 1 (H1) - Large Title</h1>
					<code class="style-guide__code-block">font-size: 2rem; font-weight: 700;</code>
				</div>

				<div class="style-guide__typography-item">
					<h2>Heading 2 (H2) - Section Title</h2>
					<code class="style-guide__code-block">font-size: 1.5rem; font-weight: 700;</code>
				</div>

				<div class="style-guide__typography-item">
					<h3>Heading 3 (H3) - Subsection Title</h3>
					<code class="style-guide__code-block">font-size: 1.25rem; font-weight: 700;</code>
				</div>

				<div class="style-guide__typography-item">
					<p>Paragraph text (body) - This is standard paragraph text used for descriptions, body copy, and general content. Line height is set to 1.6 for optimal readability.</p>
					<code class="style-guide__code-block">font-size: 1rem; line-height: 1.6; font-weight: 400;</code>
				</div>

				<div class="style-guide__typography-item">
					<p><strong>Bold Text (font-weight: 700)</strong> - Used for emphasis and important information</p>
					<code class="style-guide__code-block">font-weight: 700;</code>
				</div>

				<div class="style-guide__typography-item">
					<p><em>Italic Text (emphasis)</em> - Used for citations and gentle emphasis</p>
					<code class="style-guide__code-block">&lt;em&gt; or &lt;i&gt; tag</code>
				</div>

				<div class="style-guide__typography-item">
					<a href="#">Link Example (blue underlined)</a> - Links inherit brand color and change on hover
					<code class="style-guide__code-block">color: var(--brand-color); text-decoration: none;</code>
				</div>
			</div>
		</section>

		<!-- ============================================ -->
		<!-- BUTTONS SECTION                             -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Buttons</h2>
			<p class="style-guide__section-description">
				Button styles and variants for user interactions
			</p>

			<div class="style-guide__component-grid">
				<div class="style-guide__component">
					<h3>Primary Button</h3>
					<div class="style-guide__preview">
						<button class="button">Click Me</button>
					</div>
					<code class="style-guide__code-block">&lt;button class="button"&gt;Click Me&lt;/button&gt;</code>
					<p class="style-guide__note">Standard green button for primary actions</p>
				</div>

				<div class="style-guide__component">
					<h3>Primary Button (Hover)</h3>
					<div class="style-guide__preview">
						<button class="button" style="background: #0f4a25; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.16);">Click Me</button>
					</div>
					<code class="style-guide__code-block">/* Hover state - darker green, lifted, shadow */</code>
					<p class="style-guide__note">Interactive feedback on hover</p>
				</div>

				<div class="style-guide__component">
					<h3>Secondary Button</h3>
					<div class="style-guide__preview">
						<button class="button button--secondary">Secondary</button>
					</div>
					<code class="style-guide__code-block">&lt;button class="button button--secondary"&gt;Secondary&lt;/button&gt;</code>
					<p class="style-guide__note">Orange button for secondary actions</p>
				</div>

				<div class="style-guide__component">
					<h3>Disabled Button</h3>
					<div class="style-guide__preview">
						<button class="button" disabled>Disabled</button>
					</div>
					<code class="style-guide__code-block">&lt;button class="button" disabled&gt;Disabled&lt;/button&gt;</code>
					<p class="style-guide__note">Faded appearance, not clickable</p>
				</div>
			</div>
		</section>

		<!-- ============================================ -->
		<!-- CARDS SECTION                               -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Cards</h2>
			<p class="style-guide__section-description">
				Card components for displaying content in organized, elevated containers
			</p>

			<div class="grid">
				<article class="card">
					<a href="#" class="card__image-link">
						<img src="https://via.placeholder.com/400x300/1b6b34/ffffff?text=Card+Image" alt="Card example">
					</a>
					<div class="card__content">
						<h3 class="card__title">Product / Service Title</h3>
						<p class="card__excerpt">Brief description of the product or service goes here. This text should be concise and engaging.</p>
						<button class="button">Learn More</button>
					</div>
				</article>

				<article class="card">
					<a href="#" class="card__image-link">
						<img src="https://via.placeholder.com/400x300/ff6b35/ffffff?text=Card+Image" alt="Card example">
					</a>
					<div class="card__content">
						<h3 class="card__title">Another Product</h3>
						<p class="card__excerpt">Each card has consistent styling with hover effects for better interactivity.</p>
						<button class="button button--secondary">View Details</button>
					</div>
				</article>

				<article class="card">
					<a href="#" class="card__image-link">
						<img src="https://via.placeholder.com/400x300/1b6b34/ffffff?text=Card+Image" alt="Card example">
					</a>
					<div class="card__content">
						<h3 class="card__title">Third Item</h3>
						<p class="card__excerpt">Cards are fully responsive and stack on mobile devices.</p>
						<button class="button">Explore</button>
					</div>
				</article>
			</div>

			<div class="style-guide__code-example">
				<p><strong>Code Example:</strong></p>
				<code class="style-guide__code-block">
&lt;article class="card"&gt;
  &lt;a href="#" class="card__image-link"&gt;
    &lt;img src="image.jpg" alt="description"&gt;
  &lt;/a&gt;
  &lt;div class="card__content"&gt;
    &lt;h3 class="card__title"&gt;Title&lt;/h3&gt;
    &lt;p class="card__excerpt"&gt;Description&lt;/p&gt;
    &lt;button class="button"&gt;Action&lt;/button&gt;
  &lt;/div&gt;
&lt;/article&gt;
				</code>
			</div>
		</section>

		<!-- ============================================ -->
		<!-- FORMS SECTION                               -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Form Elements</h2>
			<p class="style-guide__section-description">
				Form inputs with consistent styling and accessibility features
			</p>

			<div class="style-guide__form-example">
				<form>
					<div class="style-guide__form-group">
						<label for="text-input">Text Input</label>
						<input type="text" id="text-input" placeholder="Enter text...">
					</div>

					<div class="style-guide__form-group">
						<label for="email-input">Email Input</label>
						<input type="email" id="email-input" placeholder="example@email.com">
					</div>

					<div class="style-guide__form-group">
						<label for="textarea-input">Textarea</label>
						<textarea id="textarea-input" rows="4" placeholder="Enter longer text..."></textarea>
					</div>

					<div class="style-guide__form-group">
						<label for="select-input">Select Dropdown</label>
						<select id="select-input">
							<option>Choose an option</option>
							<option>Option 1</option>
							<option>Option 2</option>
							<option>Option 3</option>
						</select>
					</div>

					<div class="style-guide__form-group">
						<label>
							<input type="checkbox"> Checkbox Label
						</label>
					</div>

					<div class="style-guide__form-group">
						<label>
							<input type="radio" name="radio-group"> Radio Option 1
						</label>
						<label>
							<input type="radio" name="radio-group"> Radio Option 2
						</label>
					</div>

					<button type="submit" class="button">Submit Form</button>
				</form>
			</div>
		</section>

		<!-- ============================================ -->
		<!-- SPACING SECTION                             -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Spacing Scale</h2>
			<p class="style-guide__section-description">
				Consistent spacing values for margins, padding, and gaps
			</p>

			<div class="style-guide__spacing">
				<div class="style-guide__spacing-item">
					<div class="style-guide__spacing-box" style="width: 0.25rem; height: 80px;"></div>
					<p><strong>xs:</strong> 0.25rem (4px)</p>
				</div>
				<div class="style-guide__spacing-item">
					<div class="style-guide__spacing-box" style="width: 0.5rem; height: 80px;"></div>
					<p><strong>sm:</strong> 0.5rem (8px)</p>
				</div>
				<div class="style-guide__spacing-item">
					<div class="style-guide__spacing-box" style="width: 1rem; height: 80px;"></div>
					<p><strong>md:</strong> 1rem (16px)</p>
				</div>
				<div class="style-guide__spacing-item">
					<div class="style-guide__spacing-box" style="width: 1.5rem; height: 80px;"></div>
					<p><strong>lg:</strong> 1.5rem (24px)</p>
				</div>
				<div class="style-guide__spacing-item">
					<div class="style-guide__spacing-box" style="width: 2rem; height: 80px;"></div>
					<p><strong>xl:</strong> 2rem (32px)</p>
				</div>
				<div class="style-guide__spacing-item">
					<div class="style-guide__spacing-box" style="width: 4rem; height: 80px;"></div>
					<p><strong>xxl:</strong> 4rem (64px)</p>
				</div>
			</div>
		</section>

		<!-- ============================================ -->
		<!-- UTILITY CLASSES SECTION                     -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Utility Classes</h2>
			<p class="style-guide__section-description">
				Quick helper classes for common styling patterns
			</p>

			<div class="style-guide__utilities">
				<h3>Display Utilities</h3>
				<code>.u-hidden</code>
				<code>.u-block</code>
				<code>.u-inline</code>
				<code>.u-inline-block</code>
				<code>.u-flex</code>
				<code>.u-grid</code>

				<h3 style="margin-top: 2rem;">Flexbox Utilities</h3>
				<code>.u-flex-center</code> &mdash; Centers content horizontally and vertically
				<code>.u-flex-between</code> &mdash; Space-between layout

				<h3 style="margin-top: 2rem;">Text Utilities</h3>
				<code>.u-text-center</code>
				<code>.u-text-right</code>
				<code>.u-text-left</code>
				<code>.u-font-bold</code>
				<code>.u-font-medium</code>
				<code>.u-font-normal</code>

				<h3 style="margin-top: 2rem;">Margin Utilities</h3>
				<code>.u-mb</code> / <code>.u-mb-sm</code> / <code>.u-mb-md</code> / <code>.u-mb-lg</code>
				<code>.u-mt</code> / <code>.u-mt-sm</code> / <code>.u-mt-md</code> / <code>.u-mt-lg</code>

				<h3 style="margin-top: 2rem;">Padding Utilities</h3>
				<code>.u-p</code> / <code>.u-p-sm</code> / <code>.u-p-md</code> / <code>.u-p-lg</code>
				<code>.u-px</code> (left + right) / <code>.u-py</code> (top + bottom)
			</div>
		</section>

		<!-- ============================================ -->
		<!-- GRID SECTION                                -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Grid Layout</h2>
			<p class="style-guide__section-description">
				Responsive grid system for displaying content
			</p>

			<p><strong>Desktop (3 columns):</strong></p>
			<div class="grid">
				<div class="style-guide__grid-demo">Grid Item 1</div>
				<div class="style-guide__grid-demo">Grid Item 2</div>
				<div class="style-guide__grid-demo">Grid Item 3</div>
				<div class="style-guide__grid-demo">Grid Item 4</div>
				<div class="style-guide__grid-demo">Grid Item 5</div>
				<div class="style-guide__grid-demo">Grid Item 6</div>
			</div>

			<code class="style-guide__code-block" style="margin-top: 2rem;">
&lt;div class="grid"&gt;
  &lt;!-- Items automatically responsive --&gt;
&lt;/div&gt;
			</code>
		</section>

		<!-- ============================================ -->
		<!-- DESIGN PRINCIPLES SECTION                   -->
		<!-- ============================================ -->
		<section class="style-guide__section">
			<h2 class="style-guide__section-title">Design Principles</h2>
			<p class="style-guide__section-description">
				Core values guiding design decisions
			</p>

			<div class="style-guide__principles">
				<div class="style-guide__principle">
					<h3>✓ Accessibility First</h3>
					<p>All interactive elements have proper focus states for keyboard navigation. Color contrast meets WCAG AA standards.</p>
				</div>

				<div class="style-guide__principle">
					<h3>✓ Mobile-First Responsive</h3>
					<p>Design starts mobile and enhances for larger screens. Touch-friendly targets are minimum 44x44px.</p>
				</div>

				<div class="style-guide__principle">
					<h3>✓ Consistent Spacing</h3>
					<p>All spacing uses a defined scale (xs, sm, md, lg, xl, xxl) for visual harmony and predictability.</p>
				</div>

				<div class="style-guide__principle">
					<h3>✓ DRY Code</h3>
					<p>Reusable variables, mixins, and components minimize duplication and simplify maintenance.</p>
				</div>

				<div class="style-guide__principle">
					<h3>✓ Performance Optimized</h3>
					<p>Smooth transitions (0.15s - 0.3s), minimal animations, and optimized shadow system.</p>
				</div>

				<div class="style-guide__principle">
					<h3>✓ Semantic HTML</h3>
					<p>Code uses proper HTML semantics for better accessibility, SEO, and maintainability.</p>
				</div>
			</div>
		</section>

	</div><!-- .container -->
</div><!-- .site-main -->

<?php
get_footer();
