Bones for Genesis 2.0
==============

My fork of [eddiemachado's](https://github.com/eddiemachado/bones-genesis) Bones for Genesis. Built for Genesis 2.5+ and WordPress 4.7+.

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