Velocity Child Theme
=================

Child Theme for the Velocity System WordPress theme.

### Usage
Download the versioned ZIP from GitHub Releases and upload it from the WordPress
dashboard under Appearance > Themes. You can also extract it and upload the
`velocity-spa` directory to `wp-content/themes/` via FTP.

### Release

Update the `Version` header in `style.css`, then push the change to the `main`
branch. GitHub Actions will create a tag and release automatically. The release
asset is named `velocity-spa-{version}.zip`, while its top-level directory stays
`velocity-spa`.
