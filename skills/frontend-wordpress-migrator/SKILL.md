---
name: frontend-wordpress-migrator
description: Migrate website interfaces into custom WordPress themes from React, Vite, Next.js, static HTML/CSS/JS, or Figma MCP design sources while preserving layout fidelity, reusable sections, SVG-heavy composition, motion behavior, and editable content models. Use when Codex needs to convert code or design into WordPress templates or partials, model reusable sections as dynamic ACF-connected components, choose between static templates and ACF or CPT-backed content, validate the target theme and build setup before migrating, or adapt the work to theme variants such as K13 Laravel Mix when present.
---

# Frontend or Design to WordPress Migrator

## Start here

- Audit the source before editing. Inventory routes, pages, sections, reusable components, SVG assets, libraries, motion behavior, and hard-coded content when code exists.
- When the source is static HTML, inspect page structure, linked assets, inline scripts, forms, and repeated content blocks before deciding how to split templates.
- When the source comes from Figma via MCP, inspect frames, components, variables, screenshots, and any prototype or naming cues before deciding markup or motion.
- Identify the target WordPress shape early. Determine whether the project is a classic PHP theme, a custom theme with a build pipeline, or a variant such as K13 with Laravel Mix.
- Verify that the WordPress environment or theme preview actually runs before promising migration progress. Confirm theme activation, build status, homepage output, and admin access when relevant.
- Preserve fidelity to the original source. Do not add sections, copy, icons, or layout inventions unless the user explicitly asks for redesign.
- Prefer editable content models for marketing sections. Use ACF, options pages, repeaters, flexible content, CPTs, or taxonomy-backed data instead of hard-coding final content when editing is expected.
- When a section is reusable or content-driven, build it as a dynamic component or partial connected to ACF instead of leaving it trapped inside one monolithic template.
- Split large migrations into user-approved sessions when the work is staged. End each session with a working, reviewable result.

## Detect the source

- If the source is React, Vite, or Next.js, audit routes, components, state-driven sections, and imported assets before translating markup.
- If the source is static HTML/CSS/JS, identify which pages can become full templates, which blocks should become partials, and which scripts must stay global.
- If the source is Figma, use the MCP design tools to inspect design context before coding. Prefer design context and screenshots over rebuilding from guesswork.
- Read `references/source-audit.md` for the source-specific audit checklist before converting anything.

## Detect the target stack

- Inspect the theme entry points, template folders, build tooling, and plugin bootstrap before choosing where migrated code should live.
- In generic custom themes, look for files such as `functions.php`, `front-page.php`, `page.php`, `single.php`, `template-parts/`, `assets/`, `acf-json/`, and build configs.
- In build-based themes, confirm where source files live and where compiled assets are written before editing styles or scripts.
- If the repository matches the K13 Laravel Mix structure, read `references/k13-laravel-mix.md`.
- If the theme is block-first or FSE-heavy, adapt to that structure instead of forcing a PHP partial workflow that the project does not already use.

## Workflow

1. Verify the environment first. Confirm WordPress, theme activation, local URL, and build output.
2. Audit the source implementation or design. Capture sections, content structure, shared components, responsive behavior, assets, and animations that matter.
3. Decide the content model. Map static copy, groups, repeaters, flexible layouts, options pages, CPTs, taxonomies, and relationships before converting templates.
4. Decide the component model. Split reusable sections into dynamic partials or components and define which ACF fields feed each one.
5. Recreate the global structure first. Header, footer, wrappers, and page templates should match the source layout before deeper behavior work.
6. Port styles and assets into the existing theme system instead of introducing an unrelated CSS architecture.
7. Recreate interactions with one clear animation strategy. Do not let multiple libraries fight over the same elements, and do not invent motion that the source does not justify.
8. Validate in browser terms. Build, load the page, confirm no missing assets, and test the exact sections touched.

## Use the references

- Read `references/workflow.md` for the reusable migration checklist and session model.
- Read `references/source-audit.md` when the source shape is still unclear or when the input comes from static HTML or Figma MCP.
- Read `references/theme-and-acf.md` when mapping source content into WordPress templates, dynamic partials, ACF fields, options pages, flexible content, or CPTs.
- Read `references/motion-loader-hero.md` when the project includes loader choreography, hero reveals, sliders, or motion-library conflicts.
- Read `references/k13-laravel-mix.md` only when the target repository actually follows that base.

## Guardrails

- Keep the original visual hierarchy, spacing rhythm, SVG usage, and sequence timing as close as possible to the source.
- Reuse the existing CSS and build system unless the user explicitly asks for a redesign or a tooling migration.
- Inventory plugin loading and field-management conventions before changing anything. Do not introduce a second competing admin pattern when the project already has one.
- Model editable sections from the interface itself. ACF structure should mirror the real layout instead of collapsing everything into generic WYSIWYG blobs.
- Prefer dynamic ACF-connected components over giant one-off templates when the same section pattern can be reused or reordered.
- Avoid double-render or double-animation glitches. If loader, hero, and page transitions exist, sequence them intentionally.
- When the source is Figma, do not assume hidden states or transitions unless the design, prototype, or user request supports them.
- When something looks wrong, compare against the source first, not against a generic WordPress convention.
- If the theme output or build path is unclear, stop and inspect the entry points before creating templates in the wrong place.
