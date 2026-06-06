# Generic Outdoor Theme

A high-performance, professional WordPress theme built for outdoor retailers and service providers. This project demonstrates modern WordPress development workflows, custom REST API integration, and a modular SCSS design system.

## 🚀 Features

- **Custom REST API Search**: A fast, decoupled search experience that queries across multiple post types (Products, Services, Pages).
- **Modular SCSS Architecture**: Follows BEM naming conventions with a centralized Design Token system.
- **Accessibility First**: Includes accessible focus rings, reduced-motion support, and proper ARIA labeling.
- **Advanced Custom Fields (ACF)**: Seamless integration for managing product prices and metadata.

## 🛠️ Technology Stack

- **PHP / WordPress**: Core CMS functionality.
- **JavaScript (ES6+)**: Frontend interactivity and REST API consumption.
- **SCSS**: Modular styles using Dart Sass.
- **Webpack / @wordpress/scripts**: Build automation for asset minification and versioning.

## 📦 Installation & Setup

1. Clone the repository into your `wp-content/themes/` directory.
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start the development build (watches for changes):
   ```bash
   npm run start
   ```
4. Create a production-ready build:
   ```bash
   npm run build
   ```

## 🏗️ Architecture

- `/inc`: PHP partials including custom REST routes and ACF field registrations.
- `/build`: Compiled assets (managed by `wp-scripts`).
- `/css/scss`: Modular style system (Base, Layout, Components, Pages).
- `/src`: Source JavaScript modules.

## 🛡️ License

This theme is licensed under the GPLv2 or later.