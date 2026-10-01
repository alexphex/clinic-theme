# Clinic Theme

Custom WordPress theme for a dental clinic landing page. Content is edited by the site admin through custom Gutenberg blocks built with [Carbon Fields](https://carbonfields.net/). No page builders.

## Features

- 6 custom Gutenberg blocks: Hero, Services, Doctors, Testimonials, FAQ, CTA
- Contact form block: nonce, honeypot, sanitized input, email via `wp_mail()`
- Escaped output, empty fields do not break the layout
- Responsive layout (CSS grid and flexbox, no frameworks)

## Requirements

- WordPress 6.0+
- PHP 7.4+
- Composer

## Installation

1. Copy the theme to `wp-content/themes/clinic`
2. Install dependencies:
```
   composer install
```
3. Activate **Clinic** in Appearance → Themes
4. Create a page and add the blocks from the editor (search by name)

## Blocks

| Block | Fields |
|---|---|
| Hero | heading, subheading, image, button text and link |
| Services | section title, repeater: icon, name, description, price |
| Doctors | section title, repeater: photo, name, specialty, experience |
| Testimonials | section title, repeater: name, review, rating (1-5) |
| FAQ | section title, repeater: question, answer |
| CTA | heading, phone, button text, background color |
| Contact Form | heading, button text |

## Project structure

```
clinic/
  blocks/        one file per block (auto-loaded)
  inc/           contact form handler
  functions.php  Carbon Fields boot, block loader, styles
  header.php, footer.php, index.php, style.css
```

## Adding a new block

1. Create `blocks/my-block.php`
2. Register it with `Block::make()`, add fields, set the render callback
3. Add styles to `style.css`

The file is loaded automatically from `functions.php`.

## Contact form

The form posts to `admin-post.php`. The handler verifies a nonce, checks a honeypot field, sanitizes input and sends the email to the site admin address (Settings → General). Locally, emails can be checked in Mailpit (DDEV).

## Possible improvements

- AJAX form submission
- SMTP configuration for production
- Block patterns for full page layouts