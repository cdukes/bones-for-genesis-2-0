Bones for Genesis 2.0
==============

My fork of [eddiemachado's](https://github.com/eddiemachado/bones-genesis) Bones for Genesis. Built for Genesis 2.3+ and WordPress 4.7+.

A starting point for new Genesis projects. This is a starter child theme, not a dependency. Clone it. Fork it. Hack it for your own projects. Build cool things on the web.

*Issues and pull requests are welcome and will be addressed.*

**Note: As of v2.2.0, BFG uses [Grunt](http://gruntjs.com/) instead of Codekit and [Bower](http://bower.io/) instead of Git submodules. Apologies for the extra dependencies, but I believe this is a step toward fewer compile errors and less painful project management.**

## To Get Started
You'll need [Node.js](http://nodejs.org/), [Grunt](http://gruntjs.com/), and [Bower](http://bower.io/).

```
git clone https://github.com/cdukes/bones-for-genesis-2-0.git genesis-bfg
cd genesis-bfg
npm update --save-dev && bower update --save
grunt
```

*All functions are prefixed with `bfg`. Do a find-and-replace to align the these function names to your project's prefix.'*

## Developer Tools (disabled by default)
- Display database query info in your footer
- Put the site in maintenance mode for non-admins
- Grunt:
 - Automatic JS concatenation 
 - Automatic JS minification (Uglify)
 - Automatic image optimization (JPEG, PNG, GIF) 
 - SASS & Compass support
 - [Autoprefixer](https://github.com/ai/autoprefixer) and CSS minification support
 - Watches for file changes, and notifies on error

## Genesis Customizations
- Enable Genesis 2.0 HTML5 support
- Enable Genesis 2.0 responsive viewport support (disabled by default)
- Unregister default Genesis layouts (template, disabled by default)
- Unregister default Genesis widgets (template, disabled by default)
- Remove Genesis 'Layout Settings' meta boxes (template, disabled by default)
- Various other hooks to tweak Genesis's setup, such as footer widget count, menu names, post format support, etc.

## JavaScript
- 'no-js' `<body>` class for easy JS detection
- Preloaded libraries: [FitVids.js](http://fitvidsjs.com/), [iOS-Orientationchange-Fix](https://github.com/scottjehl/iOS-Orientationchange-Fix), [Superfish](https://github.com/joeldbirch/superfish), [SVGeezy](http://benhowdle.im/svgeezy/), and [jQuery placeholder](https://github.com/mathiasbynens/jquery-placeholder).

## CSS
- Submodule for normalize.scss
- Includes Genesis 2.0 clearfix
- `%clearfix` and `%image-replacement` SASS `@extend`'s
- Unstyled, nested selections following Genesis 2.0's style.css as a template
- A skeleton of helpful attribute resets and suggestions

## Document Customizations
### Header
- Remove `<head>` RSD and rel links (updated for Genesis 2.0)
- X-UA-Compatible <meta> tag
- Template for serving better favicons to iOS and modern browsers
- Enqueue custom stylesheets
- Supports an IE-only stylesheet
- Support the IE6 Universal Stylesheet
- Supports enqueuing Google Fonts (template, disabled by default)
- Enqueue jQuery from Google's CDN, with fallback to a local copy. 
- Enqueue custom scripts
- Specify custom favicon location (template, disabled by default)
- Add a 'no-js' class to `<body>`

### Post
- Remove `<p>` tags from around images
- Remove `[gallery]` short code injected styles
- Customize the post info and meta text (templates, disabled by default)
- Customize the post navigation link text (templates, disabled by default)
- Remove the (edit) link

### Archives
- Show the archive title and description, even if the Genesis fields for these aren't set (disabled by default)

### Comments
- Templates to remove comments, comment forms, pings, and/or all of these (disabled by default)

### Search
- Edit search input box and button text (template, disabled by default)
- Redirect straight to the search result when there is only one result (disabled by default)
- Limit searching to only posts (disabled by default)

### Sidebar
- Allow shortcodes in text widgets (disabled by default)
- Remove 'Recent Comments' widget injected styles

### Footer
- Customize the footer 'creds' text (template, disabled by default)
- Disable pointer events on scroll (template, disabled by default)
- IE8 icon font fix (template, disabled by default)

### Page Templates
- Force layout option for template (template, disabled by default)

## Admin Customizations
### Functionality
- Prevent the child theme from being overwritten by a WP.org theme of the same name
- Disable self-pings
- Add new image sizes, and add them to the media size select menu (templates, disabled by default)
- Force the Link Manager to be shown/hidden (disabled by default)

### Branding
- Change the /wp-login.php logo URL and title to your blog's homepage and name
- Replace the login logo (template, disabled by default)
- Make WordPress-generated emails appear 'from' your WordPress site name, instead of from 'WordPress'
- Make WordPress-generated emails appear 'from' your WordPress admin email address (disabled by default)
- Remove the 'WP' icon from the admin bar
- Change the admin panel footer text (template, disabled by default)

### Views
- Only show the admin bar to users who can at least use Posts
- Disable some or all of the default admin dashboard widgets (template, some disabled by default)
- Disable some or all of the default widgets (template, some disabled by default)
- Change the default hidden meta boxes for pages and posts (template, some hidden by default)
- Add a stylesheet for TinyMCE (disabled by default)
- Show the TinyMCE kitchen sink by default
- Change the available formats in TinyMCE (removes `h1`, `h5`, `h6`, `address`, and `pre` by default)
- Add/remove contact methods from user profiles (removes AIM, YahooIM, and Jabber by default)
- Remove dashboard menus (template, disabled by default)
- Prevent the failed login notice from specifying whether the username or the password is incorrect
- Hide the top-right help pull-down button

### Options
- Disable some or all of the default Genesis theme option meta boxes (template, some disabled by default)

## Changelog
### 2.3.49 (December 15, 2016)
- Remove `grunt-contrib-copy`
- Remove `console` fallback from `scripts.js`
- Always use `wp_safe_redirect()`
- Add `bfg_script_loader_tags()` to enable `defer` attribute on `<script>` tags (disabled by default)

### 2.3.48 (December 8, 2016)
- Update `PHP-CS-Fixer`
- Update default WP login logo size
- Don't apply `bfg_content_security_policy()` on header

### 2.3.47 (November 17, 2016)
- Remove `bfg_jquery_local_fallback()` (again)
- Run `postcss:css` in `grunt`

### 2.3.46 (November 10, 2016)
- Add AJAX URL as a `data-*` attribute on `<body>`, instead of an inline script, for better CSP compatibility (disabled by default)
- More consistent `.btn` default styles

### 2.3.45 (November 2, 2016)
- PostCSS image inlining

### 2.3.44 (October 22, 2016)
- Restore jQuery fallback, but disabled by default

### 2.3.43 (October 22, 2016)
- Add a `Content-Security-Policy` header (disabled by default)
- Move inline admin bar styles to `_type.scss` and `_print.scss`
- Remove avatar in admin bar
- Remove jQuery fallback

### 2.3.42 (October 15, 2016)
- Remove `svgs` folder
- Update `%visuallyhidden` CSS

### 2.3.41 (September 25, 2016)
- Minor PHP spacing/style changes
- Remove `bfg_ie_font_face_fix()`

### 2.3.40 (September 7, 2016)
- Add PostCSS modules: `postcss-flexbugs-fixes`, `postcss-import`, `postcss-easings`
- Remove Grunt modules: `csslint`, `grunticon`, `stylelint`
- Switch to PostCSS's `autoprefixer`, since `grunt-autoprefixer` is deprecated
- Turn off `flexbox` for `autoprefixer` by default
- Use `normalize.css` instead of `normalize.scss`

### 2.3.39 (August 20, 2016)
- Add SCSS to hide the WP admin bar on mobile (disabled by default)
- Allow `favicon.ico` to be loaded from the `images` folder

### 2.3.38 (August 7, 2016)
- Remove `jquery.fitvids` from `bower.json`
- Use `grunt-sass` instead of `grunt-contrib-sass` (faster than Ruby)
- Add `bfg_enable_svg_uploads()` (disabled by default)
- Add filter for `genesis_pre_get_option_site_layout()` to `layout.php` (disabled by default)
- Add `search.php` to override Genesis's

### 2.3.37 (July 26, 2016)
- Use [brand-colors](https://github.com/reimertz/brand-colors)
- Use [postcss-color-rgba-fallback](https://github.com/postcss/postcss-color-rgba-fallback)
- Use WP 4.6's `wp_resource_hints` filter
- Remove code deregistering WP's Open Sans font
- Use WP 4.6's font stack in `_variables.scss`

### 2.3.36 (July 23, 2016)
- Remove scripts not needed on modern browsers
- Replace `FitVids.js` with `vanilla-fitvids`

### 2.3.35 (July 7, 2016)
- `pre_get_posts` is an action, not a filter
- Higher specificity on `bfg_replace_login_logo()`
- Remove `wp_shortlink_wp_head()`
- Add `bfg_add_tinymce_plugins()` (disabled by default)

### 2.3.34 (June 28, 2016)
- Upgrade `jQuery` version to 3.0.0
- Add `jQuery` to bower and use this version for non-CDN fallback, instead of WP's version
- Remove IE-specific code
- Add `.gallery` scaffold SCSS
- Add wrapper default padding
- Use full `flex` syntax

### 2.3.33 (June 15, 2016)
- Use [Stylelint](https://github.com/stylelint/stylelint) for better SCSS consistency
- Force strict JS
- Added `bfg_load_child_theme_textdomain()` (disabled by default)
- Updated jQuery version
- Various style tweaks

### 2.3.32 (May 17, 2016)
- Add `genesis_404_entry_title` filter to `404.php`
- Use `normalize.scss` instead of `sanitize.css`
- `"use strict"` on JS files
- Remove hyphens on paragraph text

### 2.3.31 (May 2, 2016)
- Remove superfish
- Remove `:focus` override
- Tweak default styles
- Tweak `@media print` styles
- Fix bugs related to `include-media-export` usage
- Add `bfg_limit_menu_depth` to limit the number of submenus for the default menus
- Enable more HTML5 and accessibility features

### 2.3.30 (April 26, 2016)
- Add archive SCSS template
- Enable JS source maps
- Add `bfg_remove_meta_boxes` - partially disabled by default 
- Remove the Genesis user meta boxes - disabled by default

### 2.3.29 (April 3, 2016)
- Remove `genesis_upgrade_redirect`
- Use `sanitize.css` instead of `normalize.scss`

### 2.3.28 (March 10, 2016)
- Remove `bfg_highlight_non_breaking_spaces`
- Unhook `genesis_load_favicon` by default
- Fix JS error in `bfg_disable_pointer_events_on_scroll`
- Remove `bfg_do_taxonomy_title_description`

### 2.3.27 (February 9, 2016)
- Use `.htaccess` to block access to development assets
- Switch to `js-cookie`, since `jquery-cookie` is deprecated
- Turn `genesis-responsive-viewport` on by default
- Remove spaces on footer scripts + better HTML formatting

### 2.3.26 (January 26, 2016)
- Remove WP-API <head> material

### 2.3.25 (January 14, 2016)
- Turn off TinyMCE's auto-expand

### 2.3.24 (January 2, 2016)
- Fix `Colors` partial reference

### 2.3.23 (December 16, 2015)
- Remove `bfg_ie_style_conditionals`
- Turn off `semantic_headings` by default
- Use `.form-table` for admin options
- Disable the 'Open Sans' loaded by the admin bar
- Add option to remove the Genesis 'Layout Settings' meta box for terms (Disabled by default)
- Use [include-media](https://github.com/eduardoboucas/include-media) and [include-media-export](https://github.com/eduardoboucas/include-media-export) to unify SCSS and JS breakpoints 

### 2.3.22 (November 22, 2015)
- CSS tweaks

### 2.3.21 (October 24, 2015)
- Update `PHP-CS-Fixer` options
- Remove excessive `%clearfix` use

### 2.3.20 (October 5, 2015)
- Better clearfixes
- Update `bfg_load_favicons()` for latest OSes

### 2.3.19 (September 15, 2015)
- Merge `bfg_load_stylesheets()` and `bfg_load_scripts()` into `bfg_load_assets()`
- Remove IE universal stylesheet
- Add `dns-prefetch` for CDN-based resources
- Unhook `genesis_register_scripts()`

### 2.3.18 (September 10, 2015)
- Allow shortcodes in text widgets by default
- Turn on filters for `the_content_more_link`, `excerpt_more`, `get_the_content_more_link`, `genesis_prev_link_text`, and `genesis_next_link_text` by default
- Remove `bfg_letterspace_abbreviations` and `bfg_hard_space_expressions` - too many issues with HTML tags being broken
- Disable `img { width: auto; height: auto; }` by default

### 2.3.17 (September 3, 2015)
- Accessibility updates for Genesis 2.2
- Other CSS tweaks
- Remove Gravity Forms-specific JS + CSS
- Check for `window.addEventListener` before running `bfg_disable_pointer_events_on_scroll()`, for better IE8 compatibility 
- Remove unnecessary role attributes

### 2.3.16 (August 19, 2015)
- Remove `csslint` from `grunt build`
- Autofocus password input on single post page
- Disable `bfg_hard_space_expressions`
- `@extend %type;` on more elements

### 2.3.15 (August 10, 2015)
- Report the number of cron tasks in queue on the admin bar (disabled by default)
- Make `404.php` translation-ready
- Add `ul, ol { overflow: hidden; }` for better wrapping around images

### 2.3.14 (July 27, 2015)
- Rename `csscomb.json` to `.csscomb.json`
- Rename `.csslintrc` to `sass/.csslintrc`
- Remove `remove-empty-rulesets` from `.csscomb.json`, since `false` isn't an allowed value
- Force a default color on form elements

### 2.3.13 (July 21, 2015)
- Add `remove-empty-rulesets` to `csscomb.json`
- Also CSSComb `_variables.scss`
- Disable `bfg_letterspace_abbreviations` - causing issues with HTML attributes
- Encode Google Font SRC properly
- Move page templates to subfolder

### 2.3.12 (July 7, 2015)
- Fix use of `word-break` to properly wrap overflowing words
- Include `grunt-contrib-csslint`. This can be triggered with `grunt csslint`, as it isn't (yet) part of `grunt build`

### 2.3.11 (June 27, 2015)
- Remove `bfg_custom_template_body_class` from `page_custom.php`. (I like using the auto-generated template `<body>` classes.)
- Make theme strings translatable, with a consistent `CHILD_THEME_TEXT_DOMAIN` domain
- Add `bfg_schema_empty()` and hooks to remove some schema attributes added by Genesis (disabled by default)
- Set default credit text for `bfg_admin_footer_text()`
- Block XMLRPC_REQUEST by default and delete `xmlrpc.php` on core upgrade
- Better, environment-aware `add_editor_style()`, disabled by default
- Remove `bfg_query_stats()` and `bfg_maintenance_mode()` helper functions. There are much better plugins for both.
- Disable comment feed RSS in `<head>` by default
- Remove `<meta name="referrer" content="origin">`, since it causes a redirect bug with password-protected posts
- Use WordPress SEO's breadcrumbs when available, falling back to Genesis's method

### 2.3.10 (June 7, 2015)
- Add `font-variant-ligatures` attribute
- Update `jQuery`

### 2.3.9 (May 28, 2015)
- Run `autoprefixer` in `grunt:default`
- Add a `Assets Version Number` field to Genesis options, for cache busting
- Disable `text-rendering: optimizeLegibility;`, per [this article](http://bocoup.com/weblog/text-rendering/)

### 2.3.8 (May 12, 2015)
- Highlight non-breaking spaces in drafts to give the author a chance to correct them
- Letterspace strings of capitals
- Link numerical expressions with hard spaces
- Also flush cache in `bfg_clear_transients_node`
- 404 template fixes

### 2.3.7 (May 3, 2015)
- Remove `<meta http-equiv="cleartype" content="on">` from `<head>`
- Add `<meta name="format-detection" content="telephone=no">` (disabled by default)
- Remove `figure` and `blockquote` margins
- Remove `Picturefill` script
- Update `@media print` styles from [HTML5 Boilerplate](https://html5boilerplate.com/)

### 2.3.6 (April 26, 2015)
- Configure and run [PHP Coding Standards Fixer](http://cs.sensiolabs.org/)
- Added `bfg_downsize_uploaded_image`, which will reduce the *original* uploaded image to the specified size (disabled by default)

### 2.3.5 (April 20, 2015)
- Alphabetize packages
- Add `.clear` class
- Better `bfg_remove_dashboard_menus` implementation
- Add `<meta name="referrer" content="origin">` to `bfg_do_doctype`, to preserve referrer information when moving from SSL to non-SSL (disabled by default)

### 2.3.4 (April 5, 2015)
- Remove `genesis_loop_else` from 404 page
- jQuery 2.0-compatible `superfish` check
- Use semantic headings
- Turn off `bfg_ie_font_face_fix` by default (replaced by SVGs)
- `min-height` for grid classes
- Minor CSS tweaks

### 2.3.3 (March 27, 2015)
- Trim extra spaces
- Include `autoprefixer` in `Gruntfile.js` `watch`
- Set `nonull` to `true` on `grunt:concat`, so warn about missing source files

### 2.3.2 (March 26, 2015)
- Move `@mixin breakpoint {}` to `_mixins.scss`
- Add `acf-json` folder placeholder for Advanced Custom Fields integration
- Add scaffold for admin JS and CSS files (disabled by default)
- Better 404 page text

### 2.3.1 (March 15, 2015)
- Incorporate some type settings from [Medium](https://medium.com/@mwichary/death-to-typewriters-technical-supplement-8f3c754626f2)
- Genesis theme setting defaults
- Add `ajax_object` JS variable (disabled by default)
- Use jQuery 2.x, with a 1.x fallback for old IE
- Only trigger `grunticon` if SVGs exist

### 2.3.0 (March 9, 2015)
- Add a `Use Production Assets?` theme setting (unchecked by default), to enable switching between minified and un-minified assets
- Remove `grunt-colorguard`
- Add `grunt-contrib-jshint` and `grunt-csscomb`
- Add `grunt icon` for SVG handling
- Split Grunt into tasks: `default` (for development) and `build` (for checking and minifying)

### 2.2.27 (February 10, 2015)
- Add `csscomb.js` to `package.json`. I would love to integrate combing into Grunt `watch`, but I can't figure out a friendly way run it on `.scss` files that I'm currently editing. For now, it can be run on the command line with `csscomb sass`.
- Modify `.csscomb.json` to work with `csscomb.js`
- Run `csscomb.js` on `sass/*`
- `return` `bfg_admin_footer_text()`, since it's a filter

### 2.2.26 (January 26, 2015)
- Add `jquery.cookie.js`
- Automatically remove `readme.html` (and optionally `xmlrpc.php`) after a WP core update

### 2.2.25 (January 22, 2015)
- Add a default spinner, with Gravity Forms support

### 2.2.24 (January 21, 2015)
- Better HTML handling for WP system emails
- Add function to get an array of image sizes
- Add hook to remove dashboard Activity widget
- Add hook to remove secondary sidebar

### 2.2.23 (December 10, 2014)
- Disable Genesis SEO by default, without conflicting with Genesis's method

### 2.2.22 (November 20, 2014)
- Consistent EOF line
- Disable Genesis SEO by default
- Running `Clear Transients` always returns you to `/wp-admin/`
- Avoid `console` errors in browsers that lack a console
- Add `order` to `.csscomb.json` sorting

### 2.2.21 (November 5, 2014)
- Use latest version of jQuery 1.x by default
- Include `animation-fill-mode` in `.csscomb.json`

### 2.2.20 (October 27, 2014)
- Run [CSSComb](http://csscomb.com/) on `.scss` files
- Add `.csscomb.json` project file

### 2.2.19 (October 25, 2014)
- Better `.gitignore`

### 2.2.18 (September 28, 2014)
- Fifths grid classes
- Turn off sourcemaps in Grunt
- Only overwrite `input[type="password"]` font on IE8
- Add default HTML/CSS for password protected post form

### 2.2.17 (September 6, 2014)
- `Gruntfile.js`: More consistent syntax
- `Gruntfile.js`: `sass` now uses `precision: 3`
- `Gruntfile.js`: `concat` no longer includes the entire `/js/` folder
- `Gruntfile.js`: `autoprefixer` now uses the default `browser` setting
- `Gruntfile.js`: `csso` now keeps `restructure` off by default
- `Gruntfile.js`: `colorguard` is no longer run by default
- Added some default styling for the search form
- Added Chrome on Android and iOS web app lines to `bfg_load_favicons()`
- Added some styles fixes from H5BP

### 2.2.16 (August 27, 2014)
- Use [Colors](https://github.com/mrmrs/colors) for better default color variables
- Don't check `is_admin()` in `wp_enqueue_scripts`, since that hook is only called on the frontend
- Better universal box-sizing

### 2.2.15 (July 13, 2014)
- Use [CSSO](https://github.com/css/csso) for CSS magnification

### 2.2.14 (July 11, 2014)
- Set all package versions in `package.json` to `*`, so that NPM will download the latest versions, then update the file with that info, on `npm update --save-dev`
- Set Bower to always pull the latest versions of its dependencies 
- Removed `grunt-svgmin`, since `grunt-contrib-imagemin` now supports SVGs
- Added `grunt-newer`, so that only changed images will be optimized when Grunt is watching for changes
- No longer create a `style.prefixed.css` file. Replace `style.css` with the prefixed version
- Added `grunt-colorguard`, which outputs warnings about similar CSS colors

### 2.2.13 (July 1, 2014)
- Version bump for Genesis 2.1.0

### 2.2.12 (June 21, 2014)
- Added `<meta http-equiv="cleartype" content="on">` for better font rendering on mobile IE
- Added better `show_admin_bar` filtering, as the old version was triggering errors in BuddyPress and bbPress.
- Better use of semver. Bower will now update its dependencies to the latest minor release of the indicated major version. (ex. It'll update to Normalize v3.0.2 and v3.1.0, but _not_ to v4.0.0.)
- Added code to disable XML-RPC entirely (code is disabled by default)

### 2.2.11 (June 21, 2014)
- Fixed some code formatting issues
- Enabled `bfg_remove_xmlrpc_pingback_ping` by default
- Removed `bfg_remove_ptags_on_images`, since it no longer works. As an alternative, I've [suggested making `wpautop()`'s block elements list filterable](https://core.trac.wordpress.org/ticket/28607)
- Set `appearance: none;` on `input` elements by default

### 2.2.10 (June 6, 2014)
- jQuery version update
- Added CSS to hide the spinner on `input[type="number"]` (disabled by default)
- Use `genesis_footer_output` instead of `genesis_footer_creds_text` to filter footer HTML

### 2.2.9 (April 24, 2014)
- Added [Picturefill](https://scottjehl.github.io/picturefill/)
- Added a clear transients button to the admin menu
- Add a plugins link to the appearance admin bar menu

### 2.2.8 (April 17, 2014)
- Better `add_theme_support( 'html5' );`, include WP 3.9's HTML5 galleries
- Added template for changing image crop positions (disabled by default)
- Added template to deregister Genesis parent theme page templates (disabled by default)

### 2.2.7 (April 17, 2014)
- Update TinyMCE filters for WP 3.9, which uses TinyMCE 4

### 2.2.6 (April 12, 2014)
- Fixed removal of `no-js` class

### 2.2.5 (April 6, 2014)
- Refactored the starter CSS
- Added template to allow pages to have excerpts (disabled by default)

### 2.2.4 (March 23, 2014)
- Use IE indicator classes in the `<html>` tag, instead of a separate IE stylesheet
- Remove manifest link

### 2.2.3 (March 16, 2014)
- Added function to disable pingbacks (disabled by default)
- Grunt will now watch SASS, JS, and image subfolders

### 2.2.2 (March 11, 2014)
- Added option to remove feed links (disabled by default)
- More consistent code spacing
- Place SASS first in Grunt process order
- Added hook to remove breadcrumbs (disabled by default)
- Better list style defaults

### 2.2.1 (March 04, 2014)
- Added SVG optimization, via Grunt
- Prevent direct access to PHP files

### 2.2.0 (March 01, 2014)
- Grunt integration
- Remove Compass @includes and sass-flex-mixin, instead use Autoprefixer

### 2.1.2 (February 24, 2014)
- Update jQuery to 1.11.0
- Document to use `--save` option when updating Bower
- Require PHP files instead of including them, as in StudioPress's [example Genesis child theme](http://www.studiopress.com/free-themes/sample)

### 2.1.1 (February 15, 2014)
- Removed iFrame border by default
- Updated normalize.scss repo reference

### 2.1.0 (January 27, 2014)
- Migrated submodules to Bower
- Added jQuery Placeholder plugin
- Fixed jQuery version reference in `includes/header.php`

### 2.0.22 (January 10, 2014)
- Removed `bfg_prevent_child_theme_update`, since Genesis 2.0.2 now does this.

### 2.0.21 (January 8, 2014)
- Added `$rss` social color variable
- Caption container `width` should be `auto`
- Split `.entry-pagination` and `.archive-pagination` styles
- Removed `overflow: hidden` on `.entry-content`, as it causes `outline` no child elements to sometimes be partially hidden

### 2.0.20 (January 2, 2014)
- Hide edit links by default
- Added `X-UA-Compatible` `<meta>` tag
- Added jQuery fallback, if Google CDN fails
- Added script to disable hover events on scroll (disabled by default)
- Prevent authors and contributors from seeing media that isn't theirs (hidden by default)
- WP 3.8 login logo styles

### 2.0.19 (December 22, 2013)
- Show archive term title if no Genesis title is set (disabled by default)
- Force monospace font for `input[type="password"]`. This resolves an issue with some @font-face fonts in IE8.
- Limit form field widths to width of container
- Added a `.one-fifth` grid option
- Added `%unstyled-list` SASS extend
- Added retina breakpoint

### 2.0.18 (November 20, 2013)
- Added a template to deregister the default Genesis menus, and add your own (deactivated by default)
- Added [flexbox mixins](https://github.com/mastastealth/sass-flex-mixin), pending proper Compass support
- Added a template to limit searches to just posts (deactivated by default)
- Added hooks to hide the author box on single posts and/or archive pages (deactivated by default)

### 2.0.17 (October 5, 2013)
- Use fixed site width on old IE fallback.
- Use `@extend %clearfix` where practical
- Don't bold or hide outline on input:focus by default
- Better old IE icon font redraw script

### 2.0.16 (September 26, 2013)
- iOS7 Favicon support
- Better list style skeleton in `_content.scss`
- Added a `visuallyhidden` @extend
- Added a template for removing pings, or the entire comments area (deactivated by default)
- Added hooks to *remove* the post_info and post_meta areas (deactivated by default)
- Added granular excerpt text filtering (deactivated by default)

### 2.0.15 (September 15, 2013)
- Added [Superfish](https://github.com/joeldbirch/superfish) for IE8 compatibility with drop-down navigation
- Added template for additional TinyMCE buttons

### 2.0.14 (September 4, 2013)
- Added [SVGeezy](http://benhowdle.im/svgeezy/) as a submodule
- Added a filter to change JPEG quality (disabled by default)
- Force the IE-only stylesheet to load after the main stylesheet

### 2.0.13 (August 29, 2013)
- Added code to remove the comments reply form. Disabled this code and the `genesis_do_comments` removal code by default.
- Deactivated the IE-only stylesheet by default
- Moved jQuery to the footer
- Added a footer script to redraw `@font-face` fonts on IE8. (Enabled by default - if you're using BFG, I *hope* you're using icon fonts, as well.)
- Submodules update

### 2.0.12 (August 19, 2013)
- Removed duplicate `box-sizing: border-box;` on `input[type="search"]`
- Added a `hide-print` class
- Removed `genesis_older_link_text` and `genesis_newer_link_text` link filter templates, since they're not used in G2.0
- Added `bfg_remove_scripts_meta_boxes` to remove the scripts metaboxes from posts and/or pages in G2.0

### 2.0.11 (August 11, 2013)
- `editor-style.scss` now imports some basic styling (type, grid, objects/images) and is toggled 'on' by default
- Better fixed-width site support (commented out by default)
- Hide widget overflows
- More concise `_header.scss`
- `.button` is now styled with `button`
- Added `genesis-style-selector` template (off by default)
- Added option to change the media manager default view to 'upload', instead of 'library' (off by default)
- Remote scripts and styles are now registered protocol-agnostically

### 2.0.10 (August 7, 2013)
*A quick update for Genesis 2.0 launch day compatibility*
- Updated `.navigation` selector to `.archive-pagination` and `.entry-pagination`
- Updated to new Genesis `clearfix`
- Updated to `add_theme_support( 'html5' );`, instead of `add_theme_support( 'genesis-html5' );`

### 2.0.9 (August 1, 2013)
- Added better incorrect login credentials error text
- Added theme support options for a custom header and post formats (disabled by default)
- Added snippets for removing the header, site title, site description, nav menus, post title, and post edit link (all disabled by default)
- Removed `table` clearfix, as it was causing `<thead>`s to collapse
- Added `%inline-block` helper SASS
- `bfg_load_scripts` doesn't need to be called with priority `999`

### 2.0.8 (July 27, 2013)
- Removed measurements from `_headings.scss`
- Added a custom body class function for page templates
- Cleaner `bfg_remove_dashboard_menus`
- Removed (non-functional) option to disable the link manager

### 2.0.7 (July 24, 2013)
- Added better defaults to `bfg_remove_theme_settings_metaboxes`
- Moved `comment-reply` enqueuing from `bfg_load_stylesheets` to `bfg_load_scripts`
- Better word break and text overflow handling

### 2.0.6 (July 20, 2013)
- `input[type="search"]` needs to be explicitly given `box-sizing`. Weird.
- '[Better Helvetica](http://css-tricks.com/snippets/css/better-helvetica/)' starter sans-serif font stack
- Buttons should have base `line-height: 1`
- Added WooCommerce theme support declaration (disabled by default)
- jQuery version bump

### 2.0.5 (July 16, 2013)
- For `comment-reply` script loading, changed `is_singular()` to `is_single() || is_page() || is_attachment()` in `bfg_load_stylesheets()` for better granularity
- Added function in `search.php` to redirect directly to the result on searches with only one result (disabled by default)
- Title links should typically inherit their `.entry-title` color, not show the default link color
- Added filters in `post.php` to customize the older/newer post navigation text (disabled by default)
- `Readme.md` updates

### 2.0.4 (July 10, 2013)
- Removed `genesis_footer_backtotop_text` filter, since it's deprecated in Genesis 2.0 with HTML5
- Added support for better favicon display
- `g_ent` is deprecated in Genesis 2.0. Switched to `html_entity_decode`, with better characters for post prev/next navigation
- Styled `pre` like `blockquote` in `_print.scss`
- Added a button click effect extend in `_toolkit.scss`
- IE image height correction

### 2.0.3 (July 4, 2013)
- Better input skeleton styles
- Added a starter breakpoint mixin
- Normalize.scss submodule update

### 2.0.2 (June 28, 2013)
- Removed page-templates folder. Templates should be in the child theme root, to properly overwrite the Genesis parent templates.
- Gave `input[type="search"]` explicit box-sizing.
- Moved `@import "shame"` to the bottom of `style.css`
- Removed `rem` font sizing skeleton
- Removed `margin-bottom: -4px` from image links
- Added `.hide-no-js` helper class
- Added `add_theme_support( 'custom-background' )`
- Initialize Genesis's `init.php` file directly now, instead of using the `genesis_setup` hook
- Added child theme definitions (`CHILD_THEME_NAME`, `CHILD_THEME_URL`, `CHILD_THEME_VERSION`)
- Commented out `text-shadow: none;` from `::selection`, since this prevents all selection styling unless `background-color` is also specified
- Removed `_grid.scss` responsive styling, since it was causing awkward breakpoint issues on non-responsive sites.
- Commented out `body { text-rendering: optimizeLegibility; }`, since this can cause display issues on poorly generated fonts.
- Removed default floats in `_layout.scss`
- Added skeleton selectors for more HTML5 input types
- Better `_print.scss`

### 2.0.1 (June 16, 2013)
- Assume SVG login logo
- Toggle link manager on/off
- Added genesis-footer-widgets option
- More consistent SASS formatting
- Commented out `width: auto` on images
- Added `_shame.scss` file

### v2.0 (June 9, 2013)
- Initial release of Genesis 2.0 BFG fork