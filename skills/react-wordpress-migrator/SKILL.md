---
name: react-wordpress-migrator
description: Convert React, Vite, or Next.js frontends into faithful WordPress themes on the Agencia K13 Laravel Mix base, especially repositories like `agenciak13-base-wordpress-laravel-mix-*` that use `src/` as the source theme and `content/themes/<slug>/` as the compiled output. Use when Codex needs to migrate a React UI into this K13 WordPress base, preserve SVG-heavy layouts and motion behavior, model editable marketing sections with ACF, validate Docker or WordPress before starting, or deliver the migration in autonomous sessions with explicit stop points.
---

# K13 React to WordPress Migrator

## Start here

- Audit the source frontend before editing. Inventory routes, sections, reusable components, SVG assets, libraries, motion behavior, and hard-coded content.
- Verify that WordPress actually runs before promising migration progress. Check theme activation, build status, homepage, admin, and Docker when present.
- Preserve fidelity to the original React code. Do not add sections, copy, icons, or layout inventions unless the user explicitly asks for redesign.
- Prefer ACF-driven content for editable marketing sections. Avoid pushing content into the classic editor when the source site is component or data driven.
- Migrate in user-approved sessions when the project is staged. Close each session cleanly and do not continue automatically after the agreed stop point.

## Default target base

- Assume the target repo is the K13 WordPress base with Laravel Mix, typically named `agenciak13-base-wordpress-laravel-mix-*`.
- Treat `src/` as the editable source theme. Do not create a second parallel theme unless the user explicitly asks for that.
- Treat `content/themes/<slug>/` as compiled output generated from Mix.
- Confirm `.env` values for `MIX_THEME_NAME` and `MIX_THEME_SLUG` before debugging missing themes in the admin.
- Expect WordPress bootstrap and plugin loading to be coordinated from `src/inc/init.php`.

## Inspect these files early

- `src/functions.php`
- `src/inc/init.php`
- `src/inc/actions/head.php`
- `src/inc/actions/footer.php`
- `src/js/base.js`
- `src/scss/app.scss`
- `src/pages/front-page.php`
- `src/pages/header.php`
- `src/pages/footer.php`
- `src/pages/partials/loader-radial-paths.php`

## Known K13 conventions

- Build with `npm.cmd run development` during implementation and `npm.cmd run production` for final verification.
- Theme-local plugins may exist in `src/plugins/` and be copied to `content/themes/<slug>/plugins/`.
- The repo may also have `content/plugins/`, but the source of truth often stays in the theme bootstrap.
- ACF is commonly embedded from `plugins/__acfpro/` and extended by `plugins/acf-custom/`.
- Rocketplug style options and helper utilities may already exist. Reuse them instead of building a second admin pattern.
- Loader, hero reveal, Swiper, Plyr, Motion, and GSAP orchestration usually live in `src/js/base.js`.

## Workflow

1. Verify the environment first. Confirm WordPress, Docker, theme activation, and build output.
2. Audit the React implementation. Capture sections, content structure, dynamic data, and every animation that matters.
3. Decide the content model. Map static copy, repeaters, options pages, CPTs, and taxonomies before converting templates.
4. Convert structure first. Header, footer, global wrappers, and page templates should match the React layout before deeper behavior work.
5. Recreate interactions with one clear animation strategy. Do not let Motion and GSAP compete for the same elements.
6. Validate every session in browser terms. Build, load the page, confirm no missing assets, and check the exact sections touched.

## Use the references

- Read `references/workflow.md` for the migration checklist and session model.
- Read `references/theme-and-acf.md` when mapping React content into WordPress templates, plugins, and ACF fields.
- Read `references/motion-loader-hero.md` when the project includes premium loader, hero reveal, staggered entrance, or library conflicts between Motion and GSAP.

## Guardrails

- Keep the original visual hierarchy, spacing rhythm, SVG usage, and sequence timing as close as possible to the React source.
- Prefer the existing CSS system unless the user explicitly requests a redesign. If the project already has SCSS, continue from it instead of replacing it with generic Bootstrap defaults.
- Inventory plugin loading before changing anything. K13 projects may load plugins from both `content/plugins` and theme-local `plugins/`, and duplicating activation can break the admin or frontend.
- Use ACF when the user wants editable sections. Model repeaters, groups, links, and options pages instead of hard-coding final content.
- Avoid double-render or double-animation glitches. Loader exit and hero entrance must be sequenced, not overlapped accidentally.
- When something looks wrong, compare against the React source first, not against a generic WordPress pattern.
- If the WordPress theme does not appear in the admin, check `.env`, generated `style.css`, compiled theme slug, and whether the build wrote to `content/themes/<slug>/`.
