Bones for Genesis 2.0
==============

Built for Genesis 3.* and WordPress 5.*.

A starting point for new Genesis projects. This is a starter child theme, not a dependency. Clone it. Fork it. Hack it for your own projects. Build cool things on the web.

*Issues and pull requests are welcome and will be addressed.*

## To Get Started
You'll need [Node.js](http://nodejs.org/).

```
git clone https://github.com/cdukes/bones-for-genesis-2-0.git genesis-bfg
cd genesis-bfg
composer install && npm install
```

Watch:

```
npm run watch
```

Build:

```
npm run build
```

## Renaming the Theme Prefix

All functions, classes, constants, handles, and the text domain are prefixed with `bfg`/`BFG`. Run this from the theme root to rename everything to your own project's prefix (replace `acme` with your prefix first):

```
NEW_PREFIX="acme"
NEW_PREFIX_CLASS=$(echo "$NEW_PREFIX" | tr '[:lower:]' '[:upper:]')

find . \( -path ./vendor -o -path ./node_modules -o -path ./build \) -prune -o \
  -type f \( -name "*.php" -o -name "*.css" -o -name "phpcs.xml" \) -print |
  while read -r f; do
    perl -pi -e "
      s/\bBFG_/${NEW_PREFIX_CLASS}_/g;
      s/\bbfg_/${NEW_PREFIX}_/g;
      s/\bbfg-/${NEW_PREFIX}-/g;
      s/\bBFG\b/${NEW_PREFIX_CLASS}/g;
      s/\bbfg\b/${NEW_PREFIX}/g;
    " "$f"
  done
```

Then re-run `npm run build` (which also runs `phpcs`) to confirm nothing was missed.
