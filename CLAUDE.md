# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Chau Chau Golf (_ccg)** is a custom WordPress theme for managing a golf community platform. Built with Tailwind CSS v4, esbuild, and vanilla JavaScript, it provides tournament management, playdate scheduling, and member registration functionality.

**Key Features:**
- Tournament registration system with custom post types
- Playdate scheduling with registration and waitlist management
- User dashboard for personal registrations
- ACF-powered flexible content layouts
- Email-based player lookup system

## Development Commands

### Asset Compilation

```bash
# Development - compile assets once
npm run dev

# Watch mode - compile on file changes
npm run watch

# Production build - minified assets
npm run prod

# Bundle for deployment - production build + zip file
npm run bundle
```

### Individual Build Tasks

```bash
# Frontend styles only
npm run development:tailwind:frontend

# Block editor styles
npm run development:tailwind:editor

# JavaScript bundling
npm run development:esbuild
```

### Code Quality

```bash
# Run all linters
npm run lint

# JavaScript linting
npm run lint:eslint

# Code formatting check
npm run lint:prettier

# Auto-fix all issues
npm run lint-fix

# PHP linting (requires Composer)
composer run php:lint

# Auto-fix PHP issues
composer run php:lint:autofix

# Lint only changed PHP files
composer run php:lint:changed
```

### Internationalization

```bash
# Generate translation .pot file
composer run make-pot
```

## Architecture & Structure

### Asset Build Pipeline

**Source → Compilation → Theme Files**

1. **CSS Pipeline:**
   - Source: `tailwind/tailwind.css` (main), `tailwind/tailwind-editor.css` (block editor)
   - Compiler: Tailwind CLI v4.0.0 with custom config at `tailwind/tailwind-typography.config.js`
   - Output: `theme/style.css` (frontend), `theme/style-editor.css` (block editor)
   - Note: Uses `_TW_TARGET=editor` environment variable for editor-specific builds

2. **JavaScript Pipeline:**
   - Source: `javascript/script.js` (frontend), `javascript/block-editor.js` (editor)
   - Bundler: esbuild (target: esnext)
   - Output: `theme/js/script.min.js`, `theme/js/block-editor.min.js`

3. **Custom CSS Organization:**
   - `tailwind/custom/` - base, components, utilities, fonts
   - `tailwind/partials/` - header, footer partial styles
   - All imported through main Tailwind entry files

### Custom Post Types & Registration System

**Architecture Pattern:** Isolated post type definitions with dedicated AJAX handlers

1. **Post Types:**
   - `playdate` - Golf playdate sessions (defined in theme/functions.php via ACF)
   - `tournament` - Tournament events (defined in theme/functions.php via ACF)
   - `playdate_reg` - Registration records (inc/post-types/playdate-registration.php)
   - `tournament_reg` - Tournament registrations (inc/post-types/tournament-registration.php)
   - `waitlist` - Overflow management (inc/post-types/waitlist.php)

2. **AJAX Registration Flow:**
   - Frontend form submission → AJAX handler → Post creation → ACF field updates → Email notifications
   - Handlers: `ccg_handle_playdate_registration()`, `handle_tournament_registration()`
   - Nonce verification: `playdate_registration_nonce`, `tournament_registration_nonce`
   - Response format: `wp_send_json_success()` / `wp_send_json_error()`

3. **Registration Data Flow:**
   ```
   Form Submit → Nonce Verify → Field Validation →
   Check Spots Available → Create Post → Save ACF Fields →
   Update Spots Count → Send Emails → Return JSON Response
   ```

4. **Spots Availability Management:**
   - Stored in ACF field: `registration_info_spots_available` (for tournaments)
   - Decremented atomically on successful registration
   - Checked before registration creation to prevent overselling

### ACF Field Architecture

**Pattern:** JSON-exported field groups stored in `acf-json/`, programmatically registered in functions.php

1. **Layout Components:**
   - Layout 241 (acf-json/layout241.json) - Hero section with cards, images gallery
   - Layout 408 (acf-json/layout408.json) - Additional layout component

2. **Registration Fields:**
   - Tournament Registration Details (group_tournament_registration_details) - Player information
   - Tournament Registration Info (group_tournament_registration_info) - Fee, deadline, spots
   - Playdate fields - Date, time, location, spots_available

3. **Field Group Strategy:**
   - Exported to JSON for version control
   - Programmatically registered in `_ccg_register_acf_fields()` and `register_tournament_registration_acf_fields()`
   - Location rules target specific post types and page templates

### Template Hierarchy & Page Routing

**Custom Page Templates:** `main-pages/` directory contains full-page templates that override default WordPress hierarchy

1. **Main Pages (main-pages/):**
   - home.php, about.php, contact.php, faqs.php
   - tournaments.php, playdates.php, membership.php
   - register.php, my-playdates.php (user dashboard)
   - partner.php

2. **Post Type Templates (theme/):**
   - single-playdate.php - Individual playdate display
   - single-tournament.php - Individual tournament display
   - archive-tournament.php - Tournament listing

3. **Template Parts (template-parts/):**
   - `content/` - Page-specific content templates (content-home.php, content-tournament.php, etc.)
   - `forms/` - Registration forms (playdate-registration-form.php, tournament-registration-form.php, playdate-waitlist-form.php)
   - `layout/` - Reusable layout components (header-content.php, footer-content.php)

4. **Template Loading Pattern:**
   ```php
   // In page template (e.g., main-pages/home.php)
   get_template_part('template-parts/content/content-home');

   // In content template
   // Display ACF fields, include forms, etc.
   ```

### Navigation & Menu System

**Custom Walker Classes:** Tailwind-styled navigation with dropdown support

1. **Primary Navigation (CCG_Walker_Nav_Menu):**
   - Supports nested dropdowns with `menu-item-has-children` detection
   - CSS classes: `relative group` for parent items, `absolute` positioning for submenus
   - Hover-based dropdown reveal: `hidden group-hover:block`
   - JavaScript handles chevron icons and mobile interactions

2. **Footer Navigation (CCG_Footer_Walker_Nav_Menu):**
   - Simplified footer menu styling
   - Typography: `py-2 text-sm font-semibold`

3. **Menu Locations:**
   - menu-1: Primary header navigation
   - menu-2: Footer menu
   - footer-column-1, footer-column-2: Footer widget areas

### Theme Customizer Integration

**Pattern:** Customizer settings stored in wp_options, accessed via `get_theme_mod()`

**Customizer Sections:**
- footer_section - Footer heading, text, button URLs/labels
- Social media URLs (Facebook, Instagram, Twitter, LinkedIn, YouTube)
- Copyright text

**Usage:**
```php
$footer_heading = get_theme_mod('footer_heading', 'Stay Connected with Chau Chau Golf');
$join_button_url = get_theme_mod('join_button_url', '/join');
```

### Typography & Editor Styles

**Tailwind Typography Integration:** Applied consistently across frontend, block editor, and TinyMCE

1. **Typography Classes Constant:**
   ```php
   _CCG_TYPOGRAPHY_CLASSES = 'prose prose-neutral max-w-none prose-a:text-primary'
   ```

2. **Application Points:**
   - Frontend: Applied via `_ccg_content_class()` function in templates
   - Block Editor: Injected via `javascript/block-editor.js` (dynamically adds classes)
   - TinyMCE: Added to body class via `_ccg_tinymce_add_class()` filter

3. **Custom Typography Config:**
   - Config file: `tailwind/tailwind-typography.config.js`
   - Theme colors mapped to typography variables
   - Custom `_ccg` variant with project-specific color scheme

### JavaScript Architecture

**Pattern:** Vanilla JavaScript with minimal dependencies, no jQuery

1. **Frontend Script (javascript/script.js):**
   - Modal functionality (open, close, backdrop click, ESC key)
   - Event delegation for dynamic content
   - Background scroll prevention when modal open

2. **Block Editor Script (javascript/block-editor.js):**
   - Applies Tailwind Typography classes to block editor
   - MutationObserver watches for DOM changes
   - Re-applies classes when blocks added/removed

3. **Third-Party Libraries:**
   - AlpineJS v3 (CDN) - FAQ accordion functionality
   - Lucide React v0.476.0 - Icon library (imported where needed)

## Important Patterns & Conventions

### Code Standards

- **PHP:** WordPress Coding Standards (WPCS) enforced via PHPCodeSniffer
- **JavaScript:** ESLint + Prettier with WordPress config
- **CSS:** Tailwind utility-first approach, custom utilities in `tailwind/custom/utilities.css`

### Version Management

```php
define('_CCG_VERSION', '0.1.0');
```
- Used for cache busting on enqueued assets
- Replaced with timestamp in production builds via `npm run bundle`

### Security Practices

1. **Nonce Verification:**
   - All AJAX handlers verify nonces before processing
   - Pattern: `wp_verify_nonce($_POST['nonce_field'], 'nonce_action')`

2. **Input Sanitization:**
   - `sanitize_text_field()`, `sanitize_email()`, `sanitize_textarea_field()`
   - `intval()`, `floatval()` for numeric inputs

3. **Output Escaping:**
   - `esc_html()`, `esc_url()`, `esc_attr()` in all templates
   - `wp_kses_post()` for rich content

### Email Notifications

**Pattern:** Plain text emails with UTF-8 encoding

```php
$headers = ['Content-Type: text/plain; charset=UTF-8'];
wp_mail($to, $subject, $message, $headers);
```

**Email Triggers:**
- User registration confirmation (playdate, tournament)
- Admin notification on new registration
- Waitlist confirmation

## WordPress-Specific Considerations

### Theme Support

Registered in `_ccg_setup()`:
- automatic-feed-links
- title-tag
- post-thumbnails
- html5 (search-form, comment-form, gallery, etc.)
- editor-styles
- responsive-embeds
- Block templates removed (uses traditional templates)

### Custom Login Branding

- Custom logo: `theme/assets/images/ccg-logo.png`
- Brand colors: Primary #269763 (green) applied to login buttons
- Login logo links to homepage (filtered via `_ccg_custom_logo_link()`)

### Widget Areas

- sidebar-1: Footer widget area
- footer-1: Footer Menu 1 column
- footer-2: Footer Menu 2 column

## Deployment

### Production Checklist

1. Run `npm run prod` to minify assets
2. Run `composer run php:lint` to check PHP standards
3. Run `npm run lint` to check JS/CSS
4. Test registration workflows (playdate, tournament, waitlist)
5. Verify email notifications are sent
6. Check ACF field exports are in `acf-json/`
7. Run `npm run bundle` to create deployable zip file

### Zip Bundle Contents

Created by `node_scripts/zip.js`:
- All theme files from `theme/` directory
- Compiled assets (style.css, script.min.js)
- ACF JSON field groups
- Excludes: node_modules, source files, development configs
