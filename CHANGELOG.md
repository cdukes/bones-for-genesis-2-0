# 20250728
- Use PHP 8.4 functions
- Output PNG and WEBP images as AVIF

# 20250514
- Minor CSS changes for consistency

## 20250318
- Adjust `bfg_process_image()` cropping logic to handle edge case
- Better `robots.txt` formatting
- Update `eslint.config.js`

## 20241217
- Use `@use` SCSS

## 20241118
- Use `@use` SCSS
- Support for `<p class="${class}">` in `display_node()`
- Update `smlp_replace_login_logo()` admin CSS

## 20241007
- Remove `typescript`

## 20240715
- Silence `sass` `mixed-decls` deprecation

## 20240415
- eslint 9 support

## 202404043
- AVIF support

## 20240313
- Revert favicon changes for Safari compatibility
- Add `bfg_gform_entry_is_spam()` to flag Cyrillic submissions as spam (disabled by default)
- Remove `instant.page`
- Update `<img>` lazy load handling

## 20240229
- Start using `Typescript`
- Set `AllowDynamicProperties` for PHP 8.2
- Set `text-wrap: balance;` for headings

## 20240201
- Include `symfony/polyfill-php83`
- Hide the Limit Login Attempts Reloaded dashboard meta box
- Disable Gravity Forms CSS (disabled by default)
- Remove fonts not allowed by Firefox finterprinting protection

## 20231220
- Minor CSS tweaks
- Remove `Cleanup <head>` (handled by Yoast SEO)
- Remove `bfg_resource_hints()`
- Rename `bfg_get_inline_icon()` to `bfg_get_icon()`
- Add `spellcheck="false"` to `input[type="password"]`
- Update `bfg_load_favicons()`

## 20231117
- Fix HTML error in `bfg_get_image()`
- Remove `acf_add_options_page()` for default Site Options

## 20231024
- Allow `ForOfStatement`
- Use `eslint-plugin-simple-import-sort`
- Use `contenthash` in webpack `chunkFilename`
- Use WP 6.3 `wp_get_loading_optimization_attributes`
- Vue 3 compat fixes

## 20230803
- Disable `big_image_size_threshold` by default
- Use WP 6.3's `strategy` for deferring script load

## 20230315
- Use Vue 3
- Improve `bfg_process_image()` error handling
- Replace `watch` with `nodemon`
- Replace `npm-run-all` with `concurrently`
- Remove `normalize.css`

## 20230123
- Only disable ACF admin in production if an API key is set
- Set default SVG `width` and `height` attributes

## 20221128
- Add `bfg_show_acf_settings()` to disable ACF admin in production (disabled by default)
- Update `aspect-ratio` CSS

## 20221027
- Add 6.1 `Update URI` theme header
- Add 6.1 `feed_links_extra_*` filters (disabled by default)
- Add SVG support to `bfg_get_image()`
- Remove `theme.json` and dequeue `global-styles` + `classic-theme-styles`
- Use modern iPad sizes for `@media`
- Replace `fitvids` with `aspect-ratio` CSS

## 20220829
- Replace `Image Processing Queue` with `bfg_get_image()` and `bfg_get_image_url()`
- Attempt to determine SVG width + height in `BFG_Abstract_Page_Template->display_image()`

## 20220627
- Add filter to disable `gform_enable_legacy_markup`
- Remove `.woff` support

## 20220606
- Remove `rel="noopener"`
- Remove `Referrer-Policy`
- Use `yoast_seo_development_mode` outside of production
- Don't use `local` `@font-face`
- Remove `prefers-reduced-motion` `scroll-behavior`
- Update default font stacks

## 20220518
- Add `bfg_icons` JS variable
- Remove `vue/name-property-casing`
- Disable `no-case-declarations`
- Clear orphaned term meta with `?clear-orphans=1`
- `func-style` enable `allowArrowFunctions`

## 20220504
- Replace `rfs` with a custom implementation
- Load SVGs from external spritesheet
- Don't run `the_content` filter in `BFG_Abstract_Page_Template::display_text()`
- Include empty `theme.json` to disable unused frontend SVGs and CSS variables
- Remove injected WP styles

## 20220407
- Fix PHP error on `bfg_block_bots_from_search()`
- Remove `--wp-admin--admin-bar--height` override

## 20220226
- Remove `bfg_remove_files_on_upgrade()`, since it breaks WP core integrity checks
- Removed unused script dependencies

## 20220208
- Use a self-hosted version of `instant.page`
- Don't prefetch `cdnjs.cloudflare.com` by default

## 20220126
- Remove `bfg_unset_role_attribute()`
- Remove `.admin-bar-showing` class. Use WP 5.9's `--wp-admin--admin-bar--height` instead
- Replace `csscomb` with `css-declaration-sorter`
- Remove `brand-colors`
- Add `omit_threshold` to control image lazy loading in `Abstract_Page_Template`

## 20211129
- Style disabled <option>s
- Fix `wp_mail_from_name` encoding

## 20211006
- Set `space-in-parens`

## 20210728
- HTML fix on `<svg>` icons
- Replace Gravity Forms validation errors <h2> with <p> (disabled by default)
- Remove `clearfix` on site containers
- Add `webP` support (disabled by default)

## 20210702
- Remove `animation: fadein 1s;`
- Pin `vue` to version `2`
- Use `filemtime` for asset versioning
- Block robots from search
- Remove `bfg_inject_script()`. Use `defer` instead
- Remove `svg-sprite`
- Remove `eslint-plugin-compat`
- Remove `postcss-focus`

## 20210528
- Remove unused functions
    - `bfg_redirect_single_search_result()`
    - `bfg_only_search_posts()`
    - `bfg_theme_settings_defaults()`
    - `bfg_disable_self_pings()`
    - `bfg_set_jpeg_quality()`
    - `bfg_image_size_names_choose()`
    - `bfg_remove_xmlrpc_pingback_ping()`
- Remove unused boilerplate code
- Remove `IE11` support
    - Remove polyfills
    - Remove `babel`
    - Remove `format-detection`
    - Remove script loader
- Remove browser-specific CSS
- Remove unused CSS
- Deregister `jquery` by default
- Remove nav menu item IDs by default
- Add excerpts to pages by default
- Embed SVGs directly in HTML
- Only suppress errors if `WP_DEBUG` isn't set

## 20210526
- Use SASS `math.div`
- Set default `serif` fonts

## 20210504
- Update `PHP-CS-Fixer` options (v3)
- Add `crossorigin="anonymous"` to icons prefetch

## 20210407
- Fix `wp_localize_script()` usage for WP 5.7
- Add `--cache` to `eslint`
- Require `input[type="submit"]` on search form

## 20210316
- Update `favicon` requirements
- Enable `bfg_disable_recovery_mode_emails()` by default

## 20201128
- Disable `fitvids` by default
- Remove `colors-sass`
- Disable `npm audit`

## 20201012
- Update `eslint.json` rules
- Update `webpack.config.js`
- Update `php_cs.php` rules
- Remove `scroll-margin-top`

## 20200921
- PostCSS 8 updates
- Add `$text` SCSS variable

## 20200909
- Update `postcss-loader` config
- Swap search <input> submit for a <button>

## 20200811
- Remove `crossorigin` on same-origin assets
- Update `jQuery` and `instant.page`
- Support WordPress 5.5 lazy loading images
- Support `wp_get_environment_type()`
- Include HSTS example

## 20200716
- Add scaffold code for self-hosted fonts (disabled by default)
- Support WP 5.5 `navigation-widgets` [accessibility](https://make.wordpress.org/core/2020/07/09/accessibility-improvements-to-widgets-outputting-lists-of-links-in-5-5/)
- Move `.btn` CSS to a mixin

## 20200624
- Restrict use of `for...of` JS loops (due to `babel` compile size)
- Remove unneeded PHP definitions from `functions.php`
- Remove `smooth-scroll`
- Use `scroll-behavior: smooth;` by default

## 20200610
- Polyfill `URLSearchParams`

## 20200601
- Disable admin email verification

## 20200427
- JS syntax fix

## 20200420
- Use `scroll-margin-top` when admin bar is visible
- Replace `page-break-*` with `break-*`
- Add hook to disable `wp_calculate_image_srcset` (disabled by default)
- Add hook to disable recovery mode emails (disabled by default)
- Remove customizer favicon UI and hooks

## 20200326
- Add hooks to remove Genesis header/footer scripts (disabled by default)

## 20200310
- Update `eslint.json` rules

## 20200306
- Update `eslint.json` rules
- Clear orphaned user meta, in addition to post meta
- Update `instant.page` version (load by default)
- `bfg_inject_script()` with crossOrigin = 'anonymous'`

## 20200225
- Revert "Use `namespace`, instead of function prefixes"
- Use `strict` `native_function_invocation`
- Default to `fill: currentColor;` on `svg`s

## 20200212
- Enable `prefer-const`
- Add `display_image()` method to `Abstract_Page_Template`
- Force `<option>` color

## 20200120
- Update old `/build/images/` references

## 20200105
- Don't run `babel` on admin JS files
- Use `browserslist` `defaults` setting

## 20191214
- Add support for SVG favicon
- Remove `postcss-import`
- Remove `postcss-assets`
- Remove `postcss-will-change`
- Compile `.scss` files with `webpack`
- Remove `imagemin`
- Cleanup `.gitignore`

## 20191113
- `Genesis 3.2` updates

## 20191107
- Remove `typescript` config
- Add `.btn` `:disabled` style

## 20191101
- Use Dart `sass`
- Use Webpack `aliases` for common JS partials
- Remove `open_remove_type_attr()` and `close_remove_type_attr()` - use `add_theme_support` instead

## 20190916
- Remove polyfill for `URLSearchParams`
- Add `prefer-regex-literals` to `eslint`
- Minify in `webpack`, not with `uglify`

## 20190911
- Use polyfill for `URLSearchParams`
- Add filter to remove menu item IDs (disabled by default)

## 20190830
- Use `namespace`, instead of function prefixes
- Upgrade libraries - `polyfill.io`, `jQuery`, `instant.page`
- Set `eslint` `ecmaVersion` to `10`
- Use `babel-eslint`
- Use `preconnect` resource hint
- Fix AJAX URL
- Remove `disable_genesis_schema()` (Functionality is supported natively in Genesis 3.1)
- Update `customizer_theme_settings_config()` options for Genesis 3.1
- Don't `preconnect` to `cdn.polyfill.io`

## 20190808
- Use `URLSearchParams()` to build `ajax()` action URL
- Run `aslint` on `config/`

## 20190711
- Update `eslint.json` rules
- On unsuccessful `_ajax.js` request, call `on_error()` function with `response.data` instead of throwing an `Error`
- Include `smooth-scroll` (disabled by default)

## 20190627
- Disable `scroll-behavior` by default (inconsistent behavior between browsers and with `smooth-scroll`)
- Upgrade to `ESLint 6`
- Update `eslint.json` rules
- On unsuccessful `_ajax.js` request, call `on_error()` function instead of throwing an `Error`

## 20190618
- `Genesis 3.0` compatibility
- Remove `404.php`
- Remove `search.php`
- Remove `genesis_adsense` and `genesis_color_scheme` option hooks
- Remove `theme_page_templates`  filter
- Include `display=swap` by default in `google-fonts`
- Remove `genesis-responsive-viewport` (Supported by default in `Genesis 3.0`)
- Add default `opacity` to `::placeholder`

## 20190513
- Update `login_headertitle` to `login_headertext`
- Add `bfg_disable_genesis_schema()` (disabled by default)

## 20190503
- Update theme options for [Genesis 2.10](https://studiopress.blog/genesis-2-10/)
- Remove `genesis-import-export-menu` support
- Remove `Genesis Plugins` submenu

## 20190421
- Add [Responsive Font Size](https://github.com/twbs/rfs) support (`postcss`)
- Add `open_remove_type_attr()` and `close_remove_type_attr()` to remove `type='text/javascript'` using output buffering, for better [HTML5 validation](https://validator.w3.org/) (disabled by default)
- Add `Typescript` support

## 20190327
- Remove empty files

## 20190317
- Add `instant.page` support (disabled by default)
- Add `bfg_inject_preload()`
- Add hook to remove `admin_color_scheme_picker()` (disabled by default)
- Add `bfg_hide_update_nags()`
- Move `<head>`-related code to new `BFG_Head` class

## 20190208
- Remove all `SASS` `@extend`s
- Use `eslint`'s `sort-imports`
- Update `bfg_remove_dashboard_widgets()` options

## 20181230
- `appearance` CSS
- Update `.htaccess`
- Only run `babel` on `npm run build`
- Use `system-ui` font value

## 20181215
- Update `vue` options in `eslint.json`
- Improve SVG icon accessibility
- Update `csso` CLI
- Run `npm audit` on `build`

## 20181201
- Move BFG options to ACF `Site Options`
- Define `BFG_PRODUCTION` and `BFG_VERSION`
- Force `error_reporting()` off in production
- Add `palette()` SCSS function for color management
- Add `[bfg_icon]` shortcode

## 20181109
- Remove `eslint.json` globals
- Set `Referrer-Policy` default value, to avoid issues with services that check referrers (font CDNs, Google Maps API, etc)
- Dequeue `Gutenberg` frontend CSS by default
- Remove wrapping `div` on `wp_nav_menu` by default

## 20181006
- Update JS modules syntax
- `discard` `item_spacing` in `wp_nav_menu()`

## 20180906
- Fix `genesis_header` dequeue template
- Update `webpack`

## 20180816
- Add developer tool to clear `Image Processing Queue` queue

## 20180805
- Remove `bfg_force_mandrill_payload_to_html()`
- Prevent GF filters from firing in the admin panel

## 20180730
- Add code to disable `Gravity Form` view counting (disabled by default
- Remove `:focus` overrides

## 20180728
- Organize `functions.php` as a singleton
- Add a class for `page_custom.php`'s display logic
- Add an abstract class for page helper functions
- Add support for unregistering all widgets, except for a whitelist

## 20180726
- Disable `node` in `webpack.config.js`, to prevent `eval`s from being injected into production code
- Disable performance hints in `webpack.config.js`, since they don't account for `uglify`
- Include several helper function to make `Gravity Forms` more manageable (all disabled by default)
- Enable `bfg_allowed_http_origins()` by default
- Use `em` for default spacer, not `rem`

## 20180721
- Enable `--restructure-off` on `csso`
- Disable `grid` for `autoprefixer`

## 20180714
- Update `PHP-CS-Fixer` options (v2.12.2)

## 20180712
- Enable `grid` for `autoprefixer`

## 20180626
- Don't use `dataset` on `<script>` tags. (Breaks in IE10)
- Use `genesis_site_layout` instead of `genesis_pre_get_option_site_layout`
- Add a warning to `header( 'Referrer-Policy: same-origin' );`

## 20180604
- Hide WP version in additional places
- Update jQuery CDN version
- Prevent login with username (disabled by default)
- Prevent non-SSL HTTP origins (disabled by default)
- Add admin menu tool to delete orphaned metadata

## 20180507
- Update `vue-loader`
- Remove `create_function()`

## 20180426
- Minor style and hook template changes

## 20180406
- Set default `color` and `fill`
- Trigger a display change for hovers on mobile, to allow the subnav to display without changing the current URL
- Remove `overflow: hidden;` for `.entry-title`
- Add `bfg_wpseo_breadcrumb_separator()` to allow setting the separator to a theme icon (disabled by default)

## 20180401
- Add `<header>` to 404 template
- Update `.gitignore`

## 20180315
- Throw error on `compat/compat` failure. Whitelist included `fetch()` calls
- CSS tweaks

## 20180309
- Trigger error if browser can't `fetch()`
- Genesis 2.6.0 compatibility

## 20180226
- Update for Webpack 4
- Strip `type='text/javascript'` from `<script>` tags

## 20180223
- Use browser font defaults

## 20180222
- Fix `fetch()` issue in `_ajax.js`

## 20180220
- Reorganize CSS

## 20180216
- Prevent non-symbol IDs from populating on `bfg_populate_acf_icon_options()`

## 20180211
- Fix `postcss` config

## 20180210
- Remove default `.clearfix` uses
- Allow pages to have <footer>s (disabled by default)

## 201801262
- Update `uglify-js`

## 20180126
- Enable `secure_signon_cookie` by default
- Require `composer` by default

## 20180125
- Readme

## 20180122
- Config tweaks

## 20180113
- Update `csscomb.json` settings
- Undo "Add Safari flex box fix to `@mixin clearfix`"
- Migrate from `Grunt` to `nom` scripts
- Include `normalize.css` instead of `postcss-normalize`
- Remove `_grid.scss`
- Remove `postcss-color-rgba-fallback`
- Add additional security header options (disabled by default)
- Include `_ajax.js` module

## 20180107
- Include `composer.json` with `roave/security-advisories`
- Update `eslint.json`'s Vue rules
- Remove `X-UA-Compatible`
- Add SRI support for CDN scripts
- Add Safari flex box fix to `@mixin clearfix`
- Increase `.btn` `line-height` to fix text clipping issues with certain fonts
- Remove `bfg_content_security_policy()`
- Use `rel="noopener"` with `target="_blank"`

## 20171215
- Remove `max-width` on `@mixin type` (Conflicts with WP's image injection in TinyMCE)
- Fix potential issue with `bfg_login_errors()`
- Use `rem`s for `$spacer`
- Remove layout `float`s

## 20171207
- Enable `cdnjs.cloudflare.com` resource hint by default
- Cleanup `webpack.config.js` loaders
- Disable `ordered_class_elements` validation by default

## 20171116
- Add template to remove the new `WP_Widget_Media_Gallery`

## 20171111
- use `cdnjs.com`'s `svgxuse`
- Set `ESLint` `use strict` rule

## 20171105
- Refine `ESLint` options
- Run `ESLint`

## 20171104
- Remove `JSHint`
- Setup `ESLint` options
- Add support for `Vue`
- Move `Babel` config to `package.json`

## 20171102
- Update `PHP-CS-Fixer` options (v2.8.0)

## 20171028
- Prefix SVGs with `icon-` to avoid duplicate IDs

## 20171025
- Include `polyfill.io` by default
- Use deferred script loader by default
- Update `@mixin visuallyhidden` attributes
- Add `load_script` JS module, for simple on-demand script loading

## 20171015
- Use versioning for admin assets

## 20171007
- Remove default `letter-spacing`
- User backticks by default, enforce with `eslint`
- Include `lozad` by default

## 20170926
- `max-width` on `<p>` tags
- Include `grunt-contrib-concat`
- Add `bfg_populate_acf_icon_options()`
- Set `genesis-accessibility` defaults

## 20170917
- Adjust default `li` styles

## 20170904
- Remove `jquery` from script dependencies

## 20170830
- Fix `unstyled-list` styles

## 20170817
- Change default CDN to Cloudflare (again)
- [Add accessible :focus handling](https://hackernoon.com/removing-that-ugly-focus-ring-and-keeping-it-too-6c8727fefcd2)

## 20170815
- Add an async SVG icon sprite loader
- Add support for conditional script loading (disabled by default)

## 20170806
- Use `grunt-svg-sprite` for creating an SVG `<symbol>` sprite

## 20170804
- Reorder Grunt tasks

## 20170729
- Remove `bfg_cron_count_node()`
- Remove `bfg_hidden_meta_boxes()`
- Remove `bfg_media_manager_default_view()`
- Remove `bfg_restrict_attachment_viewing()`
- Remove `bfg_maybe_disable_genesis_seo()`
- Add `exit;` after redirect in `bfg_redirect_single_search_result()`
- Only modify message in `bfg_login_errors()` if error is an invalid username or password

## 20170704
- Use `Webpack` and `Babel`
- `postcss-normalize` 4.0.0 compatibility
- Include `X-XSS-Protection`

## 20170623
- `Clear Transients` now also removed site transients.
- Set `laxbreak` on `jshint`
- Use `text-decoration-skip`

## 20170614
- Hide the WP welcome panel (disabled by default)
- Add `text-decoration: none;` to `.btn`
- Cleanup `.gitignore`

## 20170608
- Add filter to `secure_signon_cookie` (disabled by default)
- Add support for unhooking the WP 3.8 media widgets
- Register `jQuery` in the `<head>`
- Force `<body>` `margin: 0;`

## 20170606
- Use `eslint-plugin-compat`
- Move Bower dependencies to NPM

## 20170530
- Use `browserslist`
- Use `postcss-normalize` instead of `normalize.css`
- Remove `_developer-tools.scss`
- Remove `bfg_get_image_sizes()`
- Remove `bfg_downsize_uploaded_image()`

## 20170524
- Show kitchen sink by default
- Include `X-Content-Type-Options` header

## 2.3.58 (May 16, 2017)
- Update code to remove recent comments widget styles
- Add hook to remove the Genesis 'Archive Settings' fields for terms (disabled by default)

## 2.3.57 (May 5, 2017)
- Update `visuallyhidden` mixin
- Update script handling for Genesis 2.5

## 2.3.56 (April 17, 2017)
- Use `prettier` for JS formatting
- Add `connect-src` CSP for Chrome for iOS fix
- Add CSS styles to highlight some HTML content issues
- Remove default `@extend` for buttons
- Remove `bfg_do_breadcrumbs()` (Genesis will use Yoast SEO's breadcrumbs when they're enabled)
- Set `X-Frame-Options: SAMEORIGIN` header

## 2.3.55 (March 9, 2017)
- Set default paragraph styles
- Remove `font-smoothing`
- Add `format-detection` meta

## 2.3.54 (February 28, 2017)
- Register `polyfill.io` for improved browser compatibility
- Cleanup some SASS variables and `@include`s
- Remove `Content-Security-Policy-Report-Only` mode for `bfg_content_security_policy()`

## 2.3.53 (February 22, 2017)
- Use Cloudflare's CDN instead of Google's for jQuery
- Register `js-cookie` and `reqwest` from Cloudflare's CDN (not queued by default)
- Remove `bfg_disable_pointer_events_on_scroll()`
- Move changes to `CHANGELOG.md`

## 2.3.52 (February 12, 2017)
- Turn off source maps
- Turn on `mb_str_functions`
- Replace `@extend`s with `@include`s
- Tweak `posts` plugins

## 2.3.51 (February 7, 2017)
- Don't load jQuery by default
- Add `no-js` class to `<body>`, instead of `<html>`
- Use `jQuery` 2.x, instead of 3.x
- Turn off source maps

## 2.3.50 (January 8, 2017)
- Move config files to `config/`
- Add `bfg_setup_per_page_limits()` to limit the maximum number of items displayed on admin list tables
- Improve Google Fonts inclusion in `bfg_content_security_policy()`

## 2.3.49 (December 15, 2016)
- Remove `grunt-contrib-copy`
- Remove `console` fallback from `scripts.js`
- Always use `wp_safe_redirect()`
- Add `bfg_script_loader_tags()` to enable `defer` attribute on `<script>` tags (disabled by default)

## 2.3.48 (December 8, 2016)
- Update `PHP-CS-Fixer`
- Update default WP login logo size
- Don't apply `bfg_content_security_policy()` on header

## 2.3.47 (November 17, 2016)
- Remove `bfg_jquery_local_fallback()` (again)
- Run `postcss:css` in `grunt`

## 2.3.46 (November 10, 2016)
- Add AJAX URL as a `data-*` attribute on `<body>`, instead of an inline script, for better CSP compatibility (disabled by default)
- More consistent `.btn` default styles

## 2.3.45 (November 2, 2016)
- PostCSS image inlining

## 2.3.44 (October 22, 2016)
- Restore jQuery fallback, but disabled by default

## 2.3.43 (October 22, 2016)
- Add a `Content-Security-Policy` header (disabled by default)
- Move inline admin bar styles to `_type.scss` and `_print.scss`
- Remove avatar in admin bar
- Remove jQuery fallback

## 2.3.42 (October 15, 2016)
- Remove `svgs` folder
- Update `%visuallyhidden` CSS

## 2.3.41 (September 25, 2016)
- Minor PHP spacing/style changes
- Remove `bfg_ie_font_face_fix()`

## 2.3.40 (September 7, 2016)
- Add PostCSS modules: `postcss-flexbugs-fixes`, `postcss-import`, `postcss-easings`
- Remove Grunt modules: `csslint`, `grunticon`, `stylelint`
- Switch to PostCSS's `autoprefixer`, since `grunt-autoprefixer` is deprecated
- Turn off `flexbox` for `autoprefixer` by default
- Use `normalize.css` instead of `normalize.scss`

## 2.3.39 (August 20, 2016)
- Add SCSS to hide the WP admin bar on mobile (disabled by default)
- Allow `favicon.ico` to be loaded from the `images` folder

## 2.3.38 (August 7, 2016)
- Remove `jquery.fitvids` from `bower.json`
- Use `grunt-sass` instead of `grunt-contrib-sass` (faster than Ruby)
- Add `bfg_enable_svg_uploads()` (disabled by default)
- Add filter for `genesis_pre_get_option_site_layout()` to `layout.php` (disabled by default)
- Add `search.php` to override Genesis's

## 2.3.37 (July 26, 2016)
- Use [brand-colors](https://github.com/reimertz/brand-colors)
- Use [postcss-color-rgba-fallback](https://github.com/postcss/postcss-color-rgba-fallback)
- Use WP 4.6's `wp_resource_hints` filter
- Remove code deregistering WP's Open Sans font
- Use WP 4.6's font stack in `_variables.scss`

## 2.3.36 (July 23, 2016)
- Remove scripts not needed on modern browsers
- Replace `FitVids.js` with `vanilla-fitvids`

## 2.3.35 (July 7, 2016)
- `pre_get_posts` is an action, not a filter
- Higher specificity on `bfg_replace_login_logo()`
- Remove `wp_shortlink_wp_head()`
- Add `bfg_add_tinymce_plugins()` (disabled by default)

## 2.3.34 (June 28, 2016)
- Upgrade `jQuery` version to 3.0.0
- Add `jQuery` to bower and use this version for non-CDN fallback, instead of WP's version
- Remove IE-specific code
- Add `.gallery` scaffold SCSS
- Add wrapper default padding
- Use full `flex` syntax

## 2.3.33 (June 15, 2016)
- Use [Stylelint](https://github.com/stylelint/stylelint) for better SCSS consistency
- Force strict JS
- Added `bfg_load_child_theme_textdomain()` (disabled by default)
- Updated jQuery version
- Various style tweaks

## 2.3.32 (May 17, 2016)
- Add `genesis_404_entry_title` filter to `404.php`
- Use `normalize.scss` instead of `sanitize.css`
- `"use strict"` on JS files
- Remove hyphens on paragraph text

## 2.3.31 (May 2, 2016)
- Remove superfish
- Remove `:focus` override
- Tweak default styles
- Tweak `@media print` styles
- Fix bugs related to `include-media-export` usage
- Add `bfg_limit_menu_depth` to limit the number of submenus for the default menus
- Enable more HTML5 and accessibility features

## 2.3.30 (April 26, 2016)
- Add archive SCSS template
- Enable JS source maps
- Add `bfg_remove_meta_boxes` - partially disabled by default
- Remove the Genesis user meta boxes - disabled by default

## 2.3.29 (April 3, 2016)
- Remove `genesis_upgrade_redirect`
- Use `sanitize.css` instead of `normalize.scss`

## 2.3.28 (March 10, 2016)
- Remove `bfg_highlight_non_breaking_spaces`
- Unhook `genesis_load_favicon` by default
- Fix JS error in `bfg_disable_pointer_events_on_scroll`
- Remove `bfg_do_taxonomy_title_description`

## 2.3.27 (February 9, 2016)
- Use `.htaccess` to block access to development assets
- Switch to `js-cookie`, since `jquery-cookie` is deprecated
- Turn `genesis-responsive-viewport` on by default
- Remove spaces on footer scripts + better HTML formatting

## 2.3.26 (January 26, 2016)
- Remove WP-API <head> material

## 2.3.25 (January 14, 2016)
- Turn off TinyMCE's auto-expand

## 2.3.24 (January 2, 2016)
- Fix `Colors` partial reference

## 2.3.23 (December 16, 2015)
- Remove `bfg_ie_style_conditionals`
- Turn off `semantic_headings` by default
- Use `.form-table` for admin options
- Disable the 'Open Sans' loaded by the admin bar
- Add option to remove the Genesis 'Layout Settings' meta box for terms (Disabled by default)
- Use [include-media](https://github.com/eduardoboucas/include-media) and [include-media-export](https://github.com/eduardoboucas/include-media-export) to unify SCSS and JS breakpoints

## 2.3.22 (November 22, 2015)
- CSS tweaks

## 2.3.21 (October 24, 2015)
- Update `PHP-CS-Fixer` options
- Remove excessive `%clearfix` use

## 2.3.20 (October 5, 2015)
- Better clearfixes
- Update `bfg_load_favicons()` for latest OSes

## 2.3.19 (September 15, 2015)
- Merge `bfg_load_stylesheets()` and `bfg_load_scripts()` into `bfg_load_assets()`
- Remove IE universal stylesheet
- Add `dns-prefetch` for CDN-based resources
- Unhook `genesis_register_scripts()`

## 2.3.18 (September 10, 2015)
- Allow shortcodes in text widgets by default
- Turn on filters for `the_content_more_link`, `excerpt_more`, `get_the_content_more_link`, `genesis_prev_link_text`, and `genesis_next_link_text` by default
- Remove `bfg_letterspace_abbreviations` and `bfg_hard_space_expressions` - too many issues with HTML tags being broken
- Disable `img { width: auto; height: auto; }` by default

## 2.3.17 (September 3, 2015)
- Accessibility updates for Genesis 2.2
- Other CSS tweaks
- Remove Gravity Forms-specific JS + CSS
- Check for `window.addEventListener` before running `bfg_disable_pointer_events_on_scroll()`, for better IE8 compatibility
- Remove unnecessary role attributes

## 2.3.16 (August 19, 2015)
- Remove `csslint` from `grunt build`
- Autofocus password input on single post page
- Disable `bfg_hard_space_expressions`
- `@extend %type;` on more elements

## 2.3.15 (August 10, 2015)
- Report the number of cron tasks in queue on the admin bar (disabled by default)
- Make `404.php` translation-ready
- Add `ul, ol { overflow: hidden; }` for better wrapping around images

## 2.3.14 (July 27, 2015)
- Rename `csscomb.json` to `.csscomb.json`
- Rename `.csslintrc` to `sass/.csslintrc`
- Remove `remove-empty-rulesets` from `.csscomb.json`, since `false` isn't an allowed value
- Force a default color on form elements

## 2.3.13 (July 21, 2015)
- Add `remove-empty-rulesets` to `csscomb.json`
- Also CSSComb `_variables.scss`
- Disable `bfg_letterspace_abbreviations` - causing issues with HTML attributes
- Encode Google Font SRC properly
- Move page templates to subfolder

## 2.3.12 (July 7, 2015)
- Fix use of `word-break` to properly wrap overflowing words
- Include `grunt-contrib-csslint`. This can be triggered with `grunt csslint`, as it isn't (yet) part of `grunt build`

## 2.3.11 (June 27, 2015)
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

## 2.3.10 (June 7, 2015)
- Add `font-variant-ligatures` attribute
- Update `jQuery`

## 2.3.9 (May 28, 2015)
- Run `autoprefixer` in `grunt:default`
- Add a `Assets Version Number` field to Genesis options, for cache busting
- Disable `text-rendering: optimizeLegibility;`, per [this article](http://bocoup.com/weblog/text-rendering/)

## 2.3.8 (May 12, 2015)
- Highlight non-breaking spaces in drafts to give the author a chance to correct them
- Letterspace strings of capitals
- Link numerical expressions with hard spaces
- Also flush cache in `bfg_clear_transients_node`
- 404 template fixes

## 2.3.7 (May 3, 2015)
- Remove `<meta http-equiv="cleartype" content="on">` from `<head>`
- Add `<meta name="format-detection" content="telephone=no">` (disabled by default)
- Remove `figure` and `blockquote` margins
- Remove `Picturefill` script
- Update `@media print` styles from [HTML5 Boilerplate](https://html5boilerplate.com/)

## 2.3.6 (April 26, 2015)
- Configure and run [PHP Coding Standards Fixer](http://cs.sensiolabs.org/)
- Added `bfg_downsize_uploaded_image`, which will reduce the *original* uploaded image to the specified size (disabled by default)

## 2.3.5 (April 20, 2015)
- Alphabetize packages
- Add `.clear` class
- Better `bfg_remove_dashboard_menus` implementation
- Add `<meta name="referrer" content="origin">` to `bfg_do_doctype`, to preserve referrer information when moving from SSL to non-SSL (disabled by default)

## 2.3.4 (April 5, 2015)
- Remove `genesis_loop_else` from 404 page
- jQuery 2.0-compatible `superfish` check
- Use semantic headings
- Turn off `bfg_ie_font_face_fix` by default (replaced by SVGs)
- `min-height` for grid classes
- Minor CSS tweaks

## 2.3.3 (March 27, 2015)
- Trim extra spaces
- Include `autoprefixer` in `Gruntfile.js` `watch`
- Set `nonull` to `true` on `grunt:concat`, so warn about missing source files

## 2.3.2 (March 26, 2015)
- Move `@mixin breakpoint {}` to `_mixins.scss`
- Add `acf-json` folder placeholder for Advanced Custom Fields integration
- Add scaffold for admin JS and CSS files (disabled by default)
- Better 404 page text

## 2.3.1 (March 15, 2015)
- Incorporate some type settings from [Medium](https://medium.com/@mwichary/death-to-typewriters-technical-supplement-8f3c754626f2)
- Genesis theme setting defaults
- Add `ajax_object` JS variable (disabled by default)
- Use jQuery 2.x, with a 1.x fallback for old IE
- Only trigger `grunticon` if SVGs exist

## 2.3.0 (March 9, 2015)
- Add a `Use Production Assets?` theme setting (unchecked by default), to enable switching between minified and un-minified assets
- Remove `grunt-colorguard`
- Add `grunt-contrib-jshint` and `grunt-csscomb`
- Add `grunt icon` for SVG handling
- Split Grunt into tasks: `default` (for development) and `build` (for checking and minifying)

## 2.2.27 (February 10, 2015)
- Add `csscomb.js` to `package.json`. I would love to integrate combing into Grunt `watch`, but I can't figure out a friendly way run it on `.scss` files that I'm currently editing. For now, it can be run on the command line with `csscomb sass`.
- Modify `.csscomb.json` to work with `csscomb.js`
- Run `csscomb.js` on `sass/*`
- `return` `bfg_admin_footer_text()`, since it's a filter

## 2.2.26 (January 26, 2015)
- Add `jquery.cookie.js`
- Automatically remove `readme.html` (and optionally `xmlrpc.php`) after a WP core update

## 2.2.25 (January 22, 2015)
- Add a default spinner, with Gravity Forms support

## 2.2.24 (January 21, 2015)
- Better HTML handling for WP system emails
- Add function to get an array of image sizes
- Add hook to remove dashboard Activity widget
- Add hook to remove secondary sidebar

## 2.2.23 (December 10, 2014)
- Disable Genesis SEO by default, without conflicting with Genesis's method

## 2.2.22 (November 20, 2014)
- Consistent EOF line
- Disable Genesis SEO by default
- Running `Clear Transients` always returns you to `/wp-admin/`
- Avoid `console` errors in browsers that lack a console
- Add `order` to `.csscomb.json` sorting

## 2.2.21 (November 5, 2014)
- Use latest version of jQuery 1.x by default
- Include `animation-fill-mode` in `.csscomb.json`

## 2.2.20 (October 27, 2014)
- Run [CSSComb](http://csscomb.com/) on `.scss` files
- Add `.csscomb.json` project file

## 2.2.19 (October 25, 2014)
- Better `.gitignore`

## 2.2.18 (September 28, 2014)
- Fifths grid classes
- Turn off sourcemaps in Grunt
- Only overwrite `input[type="password"]` font on IE8
- Add default HTML/CSS for password protected post form

## 2.2.17 (September 6, 2014)
- `Gruntfile.js`: More consistent syntax
- `Gruntfile.js`: `sass` now uses `precision: 3`
- `Gruntfile.js`: `concat` no longer includes the entire `/js/` folder
- `Gruntfile.js`: `autoprefixer` now uses the default `browser` setting
- `Gruntfile.js`: `csso` now keeps `restructure` off by default
- `Gruntfile.js`: `colorguard` is no longer run by default
- Added some default styling for the search form
- Added Chrome on Android and iOS web app lines to `bfg_load_favicons()`
- Added some styles fixes from H5BP

## 2.2.16 (August 27, 2014)
- Use [Colors](https://github.com/mrmrs/colors) for better default color variables
- Don't check `is_admin()` in `wp_enqueue_scripts`, since that hook is only called on the frontend
- Better universal box-sizing

## 2.2.15 (July 13, 2014)
- Use [CSSO](https://github.com/css/csso) for CSS magnification

## 2.2.14 (July 11, 2014)
- Set all package versions in `package.json` to `*`, so that NPM will download the latest versions, then update the file with that info, on `npm update --save-dev`
- Set Bower to always pull the latest versions of its dependencies
- Removed `grunt-svgmin`, since `grunt-contrib-imagemin` now supports SVGs
- Added `grunt-newer`, so that only changed images will be optimized when Grunt is watching for changes
- No longer create a `style.prefixed.css` file. Replace `style.css` with the prefixed version
- Added `grunt-colorguard`, which outputs warnings about similar CSS colors

## 2.2.13 (July 1, 2014)
- Version bump for Genesis 2.1.0

## 2.2.12 (June 21, 2014)
- Added `<meta http-equiv="cleartype" content="on">` for better font rendering on mobile IE
- Added better `show_admin_bar` filtering, as the old version was triggering errors in BuddyPress and bbPress.
- Better use of semver. Bower will now update its dependencies to the latest minor release of the indicated major version. (ex. It'll update to Normalize v3.0.2 and v3.1.0, but _not_ to v4.0.0.)
- Added code to disable XML-RPC entirely (code is disabled by default)

## 2.2.11 (June 21, 2014)
- Fixed some code formatting issues
- Enabled `bfg_remove_xmlrpc_pingback_ping` by default
- Removed `bfg_remove_ptags_on_images`, since it no longer works. As an alternative, I've [suggested making `wpautop()`'s block elements list filterable](https://core.trac.wordpress.org/ticket/28607)
- Set `appearance: none;` on `input` elements by default

## 2.2.10 (June 6, 2014)
- jQuery version update
- Added CSS to hide the spinner on `input[type="number"]` (disabled by default)
- Use `genesis_footer_output` instead of `genesis_footer_creds_text` to filter footer HTML

## 2.2.9 (April 24, 2014)
- Added [Picturefill](https://scottjehl.github.io/picturefill/)
- Added a clear transients button to the admin menu
- Add a plugins link to the appearance admin bar menu

## 2.2.8 (April 17, 2014)
- Better `add_theme_support( 'html5' );`, include WP 3.9's HTML5 galleries
- Added template for changing image crop positions (disabled by default)
- Added template to deregister Genesis parent theme page templates (disabled by default)

## 2.2.7 (April 17, 2014)
- Update TinyMCE filters for WP 3.9, which uses TinyMCE 4

## 2.2.6 (April 12, 2014)
- Fixed removal of `no-js` class

## 2.2.5 (April 6, 2014)
- Refactored the starter CSS
- Added template to allow pages to have excerpts (disabled by default)

## 2.2.4 (March 23, 2014)
- Use IE indicator classes in the `<html>` tag, instead of a separate IE stylesheet
- Remove manifest link

## 2.2.3 (March 16, 2014)
- Added function to disable pingbacks (disabled by default)
- Grunt will now watch SASS, JS, and image subfolders

## 2.2.2 (March 11, 2014)
- Added option to remove feed links (disabled by default)
- More consistent code spacing
- Place SASS first in Grunt process order
- Added hook to remove breadcrumbs (disabled by default)
- Better list style defaults

## 2.2.1 (March 04, 2014)
- Added SVG optimization, via Grunt
- Prevent direct access to PHP files

## 2.2.0 (March 01, 2014)
- Grunt integration
- Remove Compass @includes and sass-flex-mixin, instead use Autoprefixer

## 2.1.2 (February 24, 2014)
- Update jQuery to 1.11.0
- Document to use `--save` option when updating Bower
- Require PHP files instead of including them, as in StudioPress's [example Genesis child theme](http://www.studiopress.com/free-themes/sample)

## 2.1.1 (February 15, 2014)
- Removed iFrame border by default
- Updated normalize.scss repo reference

## 2.1.0 (January 27, 2014)
- Migrated submodules to Bower
- Added jQuery Placeholder plugin
- Fixed jQuery version reference in `includes/header.php`

## 2.0.22 (January 10, 2014)
- Removed `bfg_prevent_child_theme_update`, since Genesis 2.0.2 now does this.

## 2.0.21 (January 8, 2014)
- Added `$rss` social color variable
- Caption container `width` should be `auto`
- Split `.entry-pagination` and `.archive-pagination` styles
- Removed `overflow: hidden` on `.entry-content`, as it causes `outline` no child elements to sometimes be partially hidden

## 2.0.20 (January 2, 2014)
- Hide edit links by default
- Added `X-UA-Compatible` `<meta>` tag
- Added jQuery fallback, if Google CDN fails
- Added script to disable hover events on scroll (disabled by default)
- Prevent authors and contributors from seeing media that isn't theirs (hidden by default)
- WP 3.8 login logo styles

## 2.0.19 (December 22, 2013)
- Show archive term title if no Genesis title is set (disabled by default)
- Force monospace font for `input[type="password"]`. This resolves an issue with some @font-face fonts in IE8.
- Limit form field widths to width of container
- Added a `.one-fifth` grid option
- Added `%unstyled-list` SASS extend
- Added retina breakpoint

## 2.0.18 (November 20, 2013)
- Added a template to deregister the default Genesis menus, and add your own (deactivated by default)
- Added [flexbox mixins](https://github.com/mastastealth/sass-flex-mixin), pending proper Compass support
- Added a template to limit searches to just posts (deactivated by default)
- Added hooks to hide the author box on single posts and/or archive pages (deactivated by default)

## 2.0.17 (October 5, 2013)
- Use fixed site width on old IE fallback.
- Use `@extend %clearfix` where practical
- Don't bold or hide outline on input:focus by default
- Better old IE icon font redraw script

## 2.0.16 (September 26, 2013)
- iOS7 Favicon support
- Better list style skeleton in `_content.scss`
- Added a `visuallyhidden` @extend
- Added a template for removing pings, or the entire comments area (deactivated by default)
- Added hooks to *remove* the post_info and post_meta areas (deactivated by default)
- Added granular excerpt text filtering (deactivated by default)

## 2.0.15 (September 15, 2013)
- Added [Superfish](https://github.com/joeldbirch/superfish) for IE8 compatibility with drop-down navigation
- Added template for additional TinyMCE buttons

## 2.0.14 (September 4, 2013)
- Added [SVGeezy](http://benhowdle.im/svgeezy/) as a submodule
- Added a filter to change JPEG quality (disabled by default)
- Force the IE-only stylesheet to load after the main stylesheet

## 2.0.13 (August 29, 2013)
- Added code to remove the comments reply form. Disabled this code and the `genesis_do_comments` removal code by default.
- Deactivated the IE-only stylesheet by default
- Moved jQuery to the footer
- Added a footer script to redraw `@font-face` fonts on IE8. (Enabled by default - if you're using BFG, I *hope* you're using icon fonts, as well.)
- Submodules update

## 2.0.12 (August 19, 2013)
- Removed duplicate `box-sizing: border-box;` on `input[type="search"]`
- Added a `hide-print` class
- Removed `genesis_older_link_text` and `genesis_newer_link_text` link filter templates, since they're not used in G2.0
- Added `bfg_remove_scripts_meta_boxes` to remove the scripts metaboxes from posts and/or pages in G2.0

## 2.0.11 (August 11, 2013)
- `editor-style.scss` now imports some basic styling (type, grid, objects/images) and is toggled 'on' by default
- Better fixed-width site support (commented out by default)
- Hide widget overflows
- More concise `_header.scss`
- `.button` is now styled with `button`
- Added `genesis-style-selector` template (off by default)
- Added option to change the media manager default view to 'upload', instead of 'library' (off by default)
- Remote scripts and styles are now registered protocol-agnostically

## 2.0.10 (August 7, 2013)
*A quick update for Genesis 2.0 launch day compatibility*
- Updated `.navigation` selector to `.archive-pagination` and `.entry-pagination`
- Updated to new Genesis `clearfix`
- Updated to `add_theme_support( 'html5' );`, instead of `add_theme_support( 'genesis-html5' );`

## 2.0.9 (August 1, 2013)
- Added better incorrect login credentials error text
- Added theme support options for a custom header and post formats (disabled by default)
- Added snippets for removing the header, site title, site description, nav menus, post title, and post edit link (all disabled by default)
- Removed `table` clearfix, as it was causing `<thead>`s to collapse
- Added `%inline-block` helper SASS
- `bfg_load_scripts` doesn't need to be called with priority `999`

## 2.0.8 (July 27, 2013)
- Removed measurements from `_headings.scss`
- Added a custom body class function for page templates
- Cleaner `bfg_remove_dashboard_menus`
- Removed (non-functional) option to disable the link manager

## 2.0.7 (July 24, 2013)
- Added better defaults to `bfg_remove_theme_settings_metaboxes`
- Moved `comment-reply` enqueuing from `bfg_load_stylesheets` to `bfg_load_scripts`
- Better word break and text overflow handling

## 2.0.6 (July 20, 2013)
- `input[type="search"]` needs to be explicitly given `box-sizing`. Weird.
- '[Better Helvetica](http://css-tricks.com/snippets/css/better-helvetica/)' starter sans-serif font stack
- Buttons should have base `line-height: 1`
- Added WooCommerce theme support declaration (disabled by default)
- jQuery version bump

## 2.0.5 (July 16, 2013)
- For `comment-reply` script loading, changed `is_singular()` to `is_single() || is_page() || is_attachment()` in `bfg_load_stylesheets()` for better granularity
- Added function in `search.php` to redirect directly to the result on searches with only one result (disabled by default)
- Title links should typically inherit their `.entry-title` color, not show the default link color
- Added filters in `post.php` to customize the older/newer post navigation text (disabled by default)
- `Readme.md` updates

## 2.0.4 (July 10, 2013)
- Removed `genesis_footer_backtotop_text` filter, since it's deprecated in Genesis 2.0 with HTML5
- Added support for better favicon display
- `g_ent` is deprecated in Genesis 2.0. Switched to `html_entity_decode`, with better characters for post prev/next navigation
- Styled `pre` like `blockquote` in `_print.scss`
- Added a button click effect extend in `_toolkit.scss`
- IE image height correction

## 2.0.3 (July 4, 2013)
- Better input skeleton styles
- Added a starter breakpoint mixin
- Normalize.scss submodule update

## 2.0.2 (June 28, 2013)
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

## 2.0.1 (June 16, 2013)
- Assume SVG login logo
- Toggle link manager on/off
- Added genesis-footer-widgets option
- More consistent SASS formatting
- Commented out `width: auto` on images
- Added `_shame.scss` file

## v2.0 (June 9, 2013)
- Initial release of Genesis 2.0 BFG fork