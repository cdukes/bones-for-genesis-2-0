Bones for Genesis 2.0
==============

My fork of [eddiemachado's](https://github.com/eddiemachado/bones-genesis) Bones for Genesis. Built for Genesis 2.0+ and WordPress 3.5+.

A starting point for new Genesis projects. This is a starter child theme, not a dependency. Clone it. Fork it. Hack it for your own projects. Build cool things on the web.

*Issues and pull requests are welcome and will be addressed.*

*All functions are prefixed with `bfg`. Do a find-and-replace to align the these function names to your project's prefix.'* 

## Developer Tools (disabled by default)
- Display database query info in your footer
- Put the site in maintenance mode for non-admins

## Genesis Customizations
- Enable Genesis 2.0 HTML5 support
- Enable Genesis 2.0 responsive viewport support (disabled by default)
- Unregister default Genesis layouts (template, disabled by default)
- Unregister default Genesis widgets  (template, disabled by default)
- Remove Genesis 'Layout Settings' meta boxes (template, disabled by default)

## JavaScript
- CodeKit-ready
- Submodules for [FitVids.js](http://fitvidsjs.com/) & [iOS orientationchange zoom bug](https://github.com/scottjehl/iOS-Orientationchange-Fix)
- 'no-js' `<body>` class for easy JS detection

## CSS
- SASS-ready, CodeKit-ready
- Includes a starter config.rb file for Compass
- Submodule for normalize.scss
- Includes Genesis 2.0 clearfix
- `%clearfix` and `%image-replacement` SASS `@extend`'s 
- Unstyled, nested selections following Genesis 2.0's style.css as a template
- A skeleton of helpful attribute resets and suggestions

## Document Customizations
### Header
- Remove `<head>` RSD and rel links (updated for Genesis 2.0)
- Template for serving better favicons to iOS and modern browsers
- Enqueue custom stylesheets
- Supports an IE-only stylesheet
- Support the IE6 Universal Stylesheet
- Supports enqueuing Google Fonts (template, disabled by default)
- Enqueue jQuery from Google's CDN
- Enqueue custom scripts
- Specify custom favicon location (template, disabled by default)
- Add a 'no-js' class to `<body>`

### Post
- Remove `<p>` tags from around images
- Remove `[gallery]` short code injected styles
- Customize the post info and meta text (templates, disabled by default)
- Customize the post navigation link text (templates, disabled by default)

### Search
- Edit search input box and button text (template, disabled by default)
- Redirect straight to the search result when there is only one result (disabled by default)

### Sidebar
- Allow shortcodes in text widgets (disabled by default)
- Remove 'Recent Comments' widget injected styles

### Footer
- Customize the footer 'creds' text (template, disabled by default)

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

## To Dos
- Add admin-options.php support for setting Genesis default options
- Add admin-options.php Genesis theme options framework
- Better SASS organization into partials, modules, etc.
- Better `.gitignore`
- Add a custom post type template
- Add custom post type schema templates
- Conditional jQuery 2.0 enqueueing 
- *(Ongoing)* More standard developer comments & better function formatting

## Further Resources
- [Genesis Explained](http://designsbynickthegeek.com/tutorials/genesis-explained-two_)

**Reminder**: Run `git submodule foreach git pull origin master` on your repo to update all submodules before beginning a new project.

## Changelog
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
- Commented out `body { text-rendering:  optimizeLegibility; }`, since this can cause display issues on poorly generated fonts.
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