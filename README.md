# Articles from Code Hunt's

A modern PHP platform for publishing AI engineering content. Hosted at [articles.codehuntspk.com](https://articles.codehuntspk.com), this app provides a public-facing articles index, a single-article reader, and a password-protected admin CMS for creating, editing, publishing, and deleting posts.

## What It Does

This platform helps you share your AI engineering work with the world:

- **Articles homepage** with featured cards and categories
- **Markdown-powered article pages** with syntax highlighting for clean code examples
- **Admin dashboard** showing post statistics and easy content management
- **Draft and published states** so you can write freely before going live
- **Featured image support** to make each post visually engaging
- **CSRF protection** keeps your admin actions secure
- **Auto-generated slugs** and reading-time estimates for better SEO

## Tech Stack

Built with modern, reliable tools:

- **PHP 8+** — fast and secure server-side processing
- **MySQL / MariaDB** — robust database for storing your content
- **Tailwind CSS via CDN** — beautiful, responsive styling without build steps
- **EasyMDE** — a polished Markdown editor that feels natural to write in
- **Parsedown** — clean Markdown rendering with safe mode for security
- **Lucide icons** — crisp, modern iconography
- **Highlight.js** — syntax highlighting that makes code pop

## Project Structure

Here's how the pieces fit together:

```text
index.php            The public articles homepage
post.php             Individual article view
setup.php            One-time database setup (delete after use!)
config.php           Database and environment settings
functions.php        Shared utilities and helper functions
admin/               Admin panel with authentication and post management
public/logo.png      Your site's favicon
```

## Features

### For Readers

- **Beautiful grid layout** with featured article cards
- **Rich metadata** showing categories, authors, and estimated reading time
- **Seamless navigation** between related articles
- **Clean Markdown rendering** with safe mode to protect against XSS
- **Syntax highlighting** that makes code examples easy to read

### For Authors

- **Secure admin panel** with session-based authentication
- **Intuitive dashboard** showing your published and draft articles
- **Full CRUD control** — create, edit, delete, and publish posts
- **Draft support** so you can write without pressure
- **Featured image upload** to make each article stand out
- **WYSIWYG Markdown editor** with live preview and autosave

## Setup

Getting started is straightforward:

### 1. Set up your database

Either edit `config.php` directly or create a `.env` file in the project root:

```env
DB_HOST=localhost
DB_NAME=articles
DB_USER=root
DB_PASS=root
SITE_NAME=Code Hunt's Articles
SITE_URL=https://articles.codehuntspk.com
SESSION_NAME=codehunt_articles_session
```

Make sure `SITE_URL` matches where your site will be hosted.

### 2. Run the setup script

Open `setup.php` in your browser once to initialize the database. It will:

- Create the `posts` and `admins` tables
- Add a default admin account
- Populate with sample articles

**Default login:**
- Username: `admin`
- Password: `admin123`

**Security note:** Change these credentials immediately after your first login, and delete `setup.php` from production.

### 3. Start using it

- **Public site:** Visit `index.php`
- **Admin login:** Go to `admin/login.php`
- **Dashboard:** Check out `admin/dashboard.php`

## Local Development

If you are running the project locally with PHP's built-in server:

```bash
php -S localhost:8000
```

Then open:

- `http://localhost:8000/` for the site
- `http://localhost:8000/setup.php` for first-time setup

## Uploads

Uploaded images are stored in `uploads/` and served from `/uploads/`.

Supported formats:

- JPG
- PNG
- GIF
- WebP

Max upload size: 5 MB

## Content Workflow

1. Log in to the admin panel
2. Create a new post
3. Write content in Markdown
4. Add metadata such as category, excerpt, author, and featured image
5. Save as draft or publish immediately

The app automatically generates:

- a unique slug from the title
- a reading-time estimate based on content length

## Notes

- Markdown is rendered through Parsedown with safe mode enabled.
- CSRF tokens are enforced for create, edit, and delete actions.
- Featured images are deleted from disk when posts are removed or replaced.
- Posts with `draft` status do not appear on the public site.